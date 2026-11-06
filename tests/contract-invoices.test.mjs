import { test } from 'node:test';
import assert from 'node:assert/strict';
import { readFileSync } from 'node:fs';
import vm from 'node:vm';

const source = readFileSync(new URL('../resources/views/demo.blade.php', import.meta.url), 'utf8');
const invoiceCode = source.slice(source.indexOf('            let contractInvoices = []'), source.indexOf('            function openTenant('));

function setup() {
    const elements = Object.fromEntries(Object.entries({
        cTenant: 't1', cBox: 'b1', cStart: '2026-11-01', cEnd: '2027-10-31',
        cPaymentDate: '2026-11-05', cPrintDate: '2026-11-02', cDuration: '12 meses',
        cPaymentMethod: 'Tarjeta', rent: '100', deposit: '50', contractInvoiceProfile: 'general',
        contractInvoiceMethod: 'Transferencia', contractInvoiceAmount: '166',
    }).map(([id, value]) => [id, { value }]));
    for (const id of ['contractInvoiceError', 'contractInvoiceRows', 'contractInvoiceAllocated', 'contractInvoiceRemaining', 'contractConfirmSummary']) elements[id] = {};
    elements.cKeysConfirmed = { checked: true }; elements.cReviewConfirmed = { checked: true };
    elements.contractConfirm = { classList: { add() {} } };
    const state = { tenants: [{ id: 't1', name: 'Ana', catalogNumber: 1 }], boxes: [{ id: 'b1', code: 'A-1', status: 'Disponible' }], requests: [], contracts: [], movements: [], documents: [], operations: [], ui: {} };
    let sequence = 0;
    const context = { state, byId: (id) => elements[id], clone: structuredClone, fmtCents: (n) => String(n), esc: String, logAudit() {}, closeContractConfirmation() {}, showView() {}, flash() {}, persistState: () => true, nextSequence: (items) => items.length + 1, createDemoId: () => String(++sequence) };
    context.tenantById = (id) => context.state.tenants.find((item) => item.id === id);
    context.boxById = (id) => context.state.boxes.find((item) => item.id === id);
    context.requestById = (id) => context.state.requests.find((item) => item.id === id);
    vm.createContext(context);
    vm.runInContext(source.slice(source.indexOf('            function contractInputError()'), source.indexOf('            let contractInvoices = []')) + invoiceCode, context);
    return { context, elements };
}

test('distribuye el total y el IVA estimado sin perder centavos al guardar', () => {
    const { context, elements } = setup();
    elements.contractInvoiceAmount.value = '50.01'; context.addContractInvoice();
    elements.contractInvoiceAmount.value = '115.99'; elements.contractInvoiceMethod.value = 'Tarjeta'; context.addContractInvoice();
    context.saveContract();
    assert.equal(context.state.contracts.length, 1);
    assert.equal(context.state.movements.length, 2);
    assert.equal(context.state.movements.reduce((sum, item) => sum + item.amountCents, 0), 16600);
    assert.equal(context.state.movements.reduce((sum, item) => sum + item.taxCents, 0), 1600);
    assert.equal(context.state.movements.reduce((sum, item) => sum + item.subtotalCents, 0), 15000);
    assert.equal(context.state.movements[0].method, 'Tarjeta');
    assert.equal(context.state.movements[1].profile, 'general');
    assert.equal(context.state.boxes[0].status, 'Ocupada');
});

test('impide guardar si falta distribuir parte del total', () => {
    const { context, elements } = setup();
    elements.contractInvoiceAmount.value = '50'; context.addContractInvoice(); context.saveContract();
    assert.equal(context.state.contracts.length, 0);
    assert.equal(context.state.boxes[0].status, 'Disponible');
    assert.match(elements.contractInvoiceError.textContent, /exactamente/);
});

test('rechaza importes superiores al saldo y perfiles fiscales incompletos', () => {
    const { context, elements } = setup();
    elements.contractInvoiceAmount.value = '167'; context.addContractInvoice();
    assert.match(elements.contractInvoiceError.textContent, /supera/);
    elements.contractInvoiceAmount.value = '166'; elements.contractInvoiceProfile.value = 'tenant'; context.addContractInvoice();
    assert.match(elements.contractInvoiceError.textContent, /RFC/);
    context.saveContract();
    assert.equal(context.state.contracts.length, 0);
});

test('revierte contrato y facturas si falla el guardado', () => {
    const { context } = setup();
    context.addContractInvoice(); context.persistState = () => false; context.saveContract();
    assert.equal(context.state.contracts.length, 0);
    assert.equal(context.state.movements.length, 0);
    assert.equal(context.state.boxes[0].status, 'Disponible');
});
