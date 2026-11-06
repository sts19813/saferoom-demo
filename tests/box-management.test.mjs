import { test } from 'node:test';
import assert from 'node:assert/strict';
import { readFileSync } from 'node:fs';
import vm from 'node:vm';

const source = readFileSync(new URL('../resources/views/demo.blade.php', import.meta.url), 'utf8');
const code = source.slice(source.indexOf('            function closeBoxModal()'), source.indexOf('            function selectBox('));

function setup() {
    const values = {
        newBoxCode: 'D-401', newBoxSize: 'L', newBoxArea: 'Nivel D', newBoxRent: '2590.00', newBoxKeys: '2', newBoxStatus: 'Disponible', boxStatus: 'Disponible', boxSize: 'L',
    };
    const elements = Object.fromEntries(Object.entries(values).map(([id, value]) => [id, { value }]));
    elements.boxModal = { classList: { add() {}, remove() {} } };
    const state = { boxes: [{ id: 'box-a101', code: 'A-101', size: 'S', area: 'Acceso A', status: 'Disponible', rentCents: 129000, keys: 2 }], auditLog: [] };
    const messages = [];
    let persisted = 0;
    let renderedBoxes = 0;
    let renderedHome = 0;
    const context = {
        state,
        byId: (id) => elements[id],
        createDemoId: (prefix) => `${prefix}-new`,
        flash: (message) => messages.push(message),
        logAudit: (action, entity, result) => state.auditLog.push({ action, entity, result }),
        persistState: () => { persisted += 1; },
        renderBoxes: () => { renderedBoxes += 1; },
        renderHome: () => { renderedHome += 1; },
        setTimeout() {},
    };

    vm.createContext(context);
    vm.runInContext(code, context);

    return { context, elements, messages, metrics: () => ({ persisted, renderedBoxes, renderedHome }) };
}

test('agrega una caja disponible y actualiza las vistas de la demo', () => {
    const { context, elements, messages, metrics } = setup();

    context.saveDemoBox();

    assert.deepEqual({ ...context.state.boxes[0] }, { id: 'box-new', code: 'D-401', size: 'L', area: 'Nivel D', status: 'Disponible', rentCents: 259000, keys: 2 });
    assert.equal(elements.boxStatus.value, 'Todas');
    assert.equal(elements.boxSize.value, 'Todas');
    assert.deepEqual(metrics(), { persisted: 1, renderedBoxes: 1, renderedHome: 1 });
    assert.match(messages.at(-1), /Caja D-401 agregada/);
});

test('no agrega una caja cuando el código ya existe', () => {
    const { context, elements, messages, metrics } = setup();
    elements.newBoxCode.value = 'a-101';

    context.saveDemoBox();

    assert.equal(context.state.boxes.length, 1);
    assert.deepEqual(metrics(), { persisted: 0, renderedBoxes: 0, renderedHome: 0 });
    assert.match(messages.at(-1), /A-101 ya existe/);
});
