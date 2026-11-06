import { test } from 'node:test';
import assert from 'node:assert/strict';
import { readFileSync } from 'node:fs';
import vm from 'node:vm';

const source = readFileSync(new URL('../resources/views/demo.blade.php', import.meta.url), 'utf8');
const code = source.slice(source.indexOf('            function documentTypeLabel('), source.indexOf('            function closeDocumentViewer()')).replace("{{ asset('images/saferoom-logo.png') }}", '/logo.png');

function setup() {
    const elements = Object.fromEntries(['documentSearch', 'documentTypeFilter', 'documentRows', 'documentCount', 'documentPreviewTitle', 'documentPreview', 'documentViewerTitle', 'documentViewerContent', 'printDocumentButton'].map((id) => [id, { value: '', innerHTML: '', textContent: '' }]));
    elements.documentViewerModal = { dataset: {}, classList: { add() {} } };
    const state = {
        documents: [
            { id: 'd1', contractId: 'c1', type: 'Contrato de arrendamiento', folio: 'DOC-1', createdAt: '2026-01-02' },
            { id: 'd2', contractId: 'c2', type: 'Contrato de arrendamiento', folio: 'DOC-2', createdAt: '2026-02-03' },
            { id: 'd3', contractId: 'missing', type: 'Otro', folio: 'DOC-3', createdAt: '2026-03-04' },
        ],
        contracts: [{ id: 'c1', tenantId: 't1', boxId: 'b1', folio: 'CT-1', startDate: '2026-01-01', endDate: '2026-12-31', rentCents: 10000, depositCents: 5000 }, { id: 'c2', tenantId: 't2', boxId: 'b2', folio: 'CT-2', startDate: '2026-01-01', endDate: '2026-12-31', rentCents: 20000, depositCents: 6000 }],
        tenants: [{ id: 't1', name: 'José Díaz' }, { id: 't2', name: 'Ana Pérez' }], boxes: [{ id: 'b1', code: 'A-1', size: 'S' }, { id: 'b2', code: 'B-2', size: 'M' }],
    };
    const context = { state, byId: (id) => elements[id], esc: (value) => String(value ?? '').replaceAll('&', '&amp;').replaceAll('<', '&lt;').replaceAll('>', '&gt;').replaceAll('"', '&quot;').replaceAll("'", '&#039;'), dateLabel: String, fmtCents: String, flash() {} };
    context.contractById = (id) => state.contracts.find((item) => item.id === id);
    context.tenantById = (id) => state.tenants.find((item) => item.id === id);
    context.boxById = (id) => state.boxes.find((item) => item.id === id);
    context.selectedContract = () => state.contracts[0];
    vm.createContext(context); vm.runInContext(code, context);
    return { context, elements };
}

test('busca por arrendatario sin depender de acentos', () => {
    const { context, elements } = setup(); elements.documentSearch.value = 'jose diaz'; context.renderDocuments();
    assert.match(elements.documentRows.innerHTML, /DOC-1/); assert.doesNotMatch(elements.documentRows.innerHTML, /DOC-2/);
    assert.equal(elements.documentCount.textContent, '1 documento encontrado');
});

test('muestra la vista previa del documento elegido y no otro del mismo tipo', () => {
    const { context, elements } = setup(); context.previewRecordedDocument('d2');
    assert.match(elements.documentViewerContent.innerHTML, /Ana Pérez/); assert.match(elements.documentViewerContent.innerHTML, /CT-2/);
    assert.match(elements.documentViewerContent.innerHTML, /DOC-2/); assert.doesNotMatch(elements.documentViewerContent.innerHTML, /José Díaz/);
});

test('protege registros sin contrato y muestra búsquedas vacías', () => {
    const { context, elements } = setup(); context.renderDocuments();
    assert.match(elements.documentRows.innerHTML, /data-document-id="d3" disabled/);
    elements.documentSearch.value = 'sin coincidencias'; context.renderDocuments();
    assert.match(elements.documentRows.innerHTML, /No hay documentos que coincidan/); assert.equal(elements.documentCount.textContent, '0 documentos encontrados');
});
