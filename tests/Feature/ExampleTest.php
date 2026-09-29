<?php

test('la página de inicio carga correctamente con los nuevos disfraces y carrito', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('GuauDisfraces');
    $response->assertSee('Mago de las Estrellas');
    $response->assertSee('Sheriff del Lejano Oeste');
    $response->assertSee('cartDrawer');
    $response->assertSee('disfraz-mago.jpg');
    $response->assertDontSee('disfraz-dino.jpg');
    $response->assertDontSee('disfraz-leon.jpg');
    $response->assertDontSee('hero-perro.jpg');
});

test('la página de catálogo muestra los 5 disfraces con sus precios y tallas', function () {
    $response = $this->get('/catalogo');

    $response->assertStatus(200);
    $response->assertSee('Catálogo de Disfraces para Perros');
    $response->assertSee('Disfraz Pequeño Mago de las Estrellas');
    $response->assertSee('Disfraz Sheriff del Lejano Oeste');
    $response->assertSee('Disfraz Master Chef Perruno');
    $response->assertSee('Disfraz Conde Drácula Vampirín');
    $response->assertSee('Disfraz Abejita Zumbadora');
    $response->assertSee('24,95 €');
    $response->assertSee('22,50 €');
    $response->assertSee('19,90 €');
    $response->assertSee('21,95 €');
    $response->assertSee('18,95 €');
    $response->assertSee('cartDrawer');
    $response->assertDontSee('disfraz-dino.jpg');
    $response->assertDontSee('disfraz-leon.jpg');
    $response->assertDontSee('hero-perro.jpg');
});

test('la página de contacto carga correctamente', function () {
    $response = $this->get('/contacto');

    $response->assertStatus(200);
    $response->assertSee('Contacto');
    $response->assertSee('cartDrawer');
});
