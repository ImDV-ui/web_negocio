<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PaginaController extends Controller
{
    /**
     * Catálogo completo de disfraces para perros disponibles en la tienda.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function getProductos(): array
    {
        return [
            [
                'id' => 1,
                'slug' => 'disfraz-mago-estelar',
                'nombre' => 'Disfraz Pequeño Mago de las Estrellas',
                'categoria' => 'Fantasía & Magia',
                'categoria_slug' => 'fantasia',
                'precio' => 24.95,
                'precio_anterior' => 29.95,
                'imagen' => 'images/disfraz-mago.jpg',
                'tag' => 'Edición Mágica ⭐',
                'rating' => 5.0,
                'reviews_count' => 48,
                'destacado' => true,
                'descripcion_corta' => 'Manto aterciopelado azul noche decorado con lunas y constelaciones doradas, cuello alzado, gorro cónico y varita.',
                'descripcion_larga' => 'Convierte a tu perro en el hechicero más tierno del reino. Este disfraz incluye una capa de terciopelo azul profundo con bordados de lunas crecientes y estrellas doradas relucientes, ribete con greca artesanal, un sombrero cónico con ajuste elástico suave que no aprieta las orejitas y una mini varita mágica decorativa con punta de cuarzo segura. Su diseño deja el lomo y las patitas completamente libres para correr y jugar sin molestias.',
                'tallas' => ['XS', 'S', 'M', 'L', 'XL'],
                'material' => 'Terciopelo suave transpirable y forro hipoalergénico',
                'cierre' => 'Velcro frontal suave bajo el pecho para ajuste instantáneo',
                'lavado' => 'Lavable a máquina a 30°C (programa delicado)',
                'incluye' => 'Capa estelar, sombrero cónico de mago y varita mágica acolchada',
            ],
            [
                'id' => 2,
                'slug' => 'disfraz-sheriff-vaquero',
                'nombre' => 'Disfraz Sheriff del Lejano Oeste',
                'categoria' => 'Aventuras & Profesiones',
                'categoria_slug' => 'aventuras',
                'precio' => 22.50,
                'precio_anterior' => 26.00,
                'imagen' => 'images/disfraz-vaquero.jpg',
                'tag' => 'Más Vendido 🤠',
                'rating' => 4.9,
                'reviews_count' => 64,
                'destacado' => true,
                'descripcion_corta' => 'Chaleco imitación ante con flecos, bandana paisley roja tradicional, cartuchera con revólver acolchado y sombrero vaquero.',
                'descripcion_larga' => '¡Llegó la ley y el orden al parque! Nuestro disfraz de Sheriff del Lejano Oeste cuenta con un chaleco ligero efecto cuero/ante con flecos vaqueros, bandana roja clásica 100% algodón, cartuchera lateral con revólver acolchado ultra seguro y un sombrero cowboy moldeado con barboquejo elástico regulable. Es ligero, fresco y súper fotogénico para paseos y eventos.',
                'tallas' => ['S', 'M', 'L', 'XL'],
                'material' => 'Antelina sintética suave y algodón transpirable',
                'cierre' => 'Tirantes elásticos inferiores y velcro dorsal',
                'lavado' => 'Limpieza con paño húmedo o lavado a mano suave',
                'incluye' => 'Chaleco con flecos, sombrero vaquero, bandana roja y cartuchera',
            ],
            [
                'id' => 3,
                'slug' => 'disfraz-master-chef',
                'nombre' => 'Disfraz Master Chef Perruno',
                'categoria' => 'Aventuras & Profesiones',
                'categoria_slug' => 'aventuras',
                'precio' => 19.90,
                'precio_anterior' => 23.50,
                'imagen' => 'images/disfraz-chef.jpg',
                'tag' => 'Top Divertido 🍳',
                'rating' => 4.8,
                'reviews_count' => 39,
                'destacado' => true,
                'descripcion_corta' => 'Delantal blanco con ribetes rojos y bordado "Paws Chef", bolsillo funcional con batidor y gorro alto de chef.',
                'descripcion_larga' => '¿Quién es el catador oficial de las mejores recetas de la casa? Este traje de Chef gourmet incluye un delantal blanco impecable ribeteado en rojo con la insignia bordada "Paws Chef", un bolsillo funcional con batidor de repostería acolchado y el icónico gorro de chef abullonado con elástico adaptable. Perfecto para fotos en la cocina, celebraciones de cumpleaños y momentos graciosos en familia.',
                'tallas' => ['XS', 'S', 'M', 'L'],
                'material' => 'Mezcla de algodón suave y poliéster fácil de lavar',
                'cierre' => 'Lazos dorsales suaves ajustables al cuerpo',
                'lavado' => 'Lavable a máquina a 30°C',
                'incluye' => 'Delantal bordado con bolsillo, gorro alto de chef y batidor acolchado',
            ],
            [
                'id' => 4,
                'slug' => 'disfraz-conde-dracula',
                'nombre' => 'Disfraz Conde Drácula Vampirín',
                'categoria' => 'Fantasía & Terror',
                'categoria_slug' => 'fantasia',
                'precio' => 21.95,
                'precio_anterior' => 25.90,
                'imagen' => 'images/disfraz-vampiro.jpg',
                'tag' => 'Especial Halloween 🦇',
                'rating' => 4.9,
                'reviews_count' => 52,
                'destacado' => true,
                'descripcion_corta' => 'Capa de terciopelo negro con forro de satén rojo rubí, imponente cuello alzado rígido y broche gótico de murciélago.',
                'descripcion_larga' => 'La elegancia de la noche llega al armario de tu mejor amigo. Esta capa de vampiro cuenta con un exterior aterciopelado negro azabache y un forro interior de satén color rubí de tacto sedoso. El cuello alzado enmarcará su carita con un aire majestuoso sin restringir su movimiento ni tapar sus ojos, rematado con una elegante pajarita en forma de murciélago con gema central.',
                'tallas' => ['XS', 'S', 'M', 'L', 'XL'],
                'material' => 'Terciopelo premium y forro de satén sedoso',
                'cierre' => 'Cierre de velcro acolchado en el pecho',
                'lavado' => 'Lavable a máquina en programa delicado',
                'incluye' => 'Capa con cuello alzado forrada en satén y broche de murciélago con gema',
            ],
            [
                'id' => 5,
                'slug' => 'disfraz-abejita-zumbadora',
                'nombre' => 'Disfraz Abejita Zumbadora',
                'categoria' => 'Animales & Naturaleza',
                'categoria_slug' => 'animales',
                'precio' => 18.95,
                'precio_anterior' => 22.00,
                'imagen' => 'images/disfraz-abejita.jpg',
                'tag' => 'Súper Tierno 🐝',
                'rating' => 5.0,
                'reviews_count' => 57,
                'destacado' => true,
                'descripcion_corta' => 'Chaleco de felpa térmica a rayas amarillas y negras, alitas transparentes de nervaduras y diadema con pompones.',
                'descripcion_larga' => '¡El disfraz más dulce y alegre de nuestra colección! Confeccionado en felpa térmica ultrasuave a rayas amarillas y negras, este chaleco mantiene a tu peludo cómodo y abrigado. Incorpora dos alitas de malla translúcida con nervaduras tipo vitral y una diadema elástica con dos antenitas flexibles coronadas con pompones amarillos que se mueven graciosamente al andar.',
                'tallas' => ['XS', 'S', 'M', 'L'],
                'material' => 'Felpa suave térmica hipoalergénica',
                'cierre' => 'Doble cierre de velcro en pecho y abdomen',
                'lavado' => 'Lavable a máquina a 30°C',
                'incluye' => 'Chaleco a rayas con alitas integradas y diadema de antenitas',
            ],
        ];
    }

    /**
     * Muestra la página principal de la tienda con productos destacados.
     */
    public function inicio(): View
    {
        $productos = self::getProductos();
        $destacados = array_slice($productos, 0, 4);

        return view('inicio', [
            'productos' => $productos,
            'destacados' => $destacados,
        ]);
    }

    /**
     * Muestra el catálogo completo de disfraces con filtros y carrito interactivo.
     */
    public function catalogo(): View
    {
        $productos = self::getProductos();
        $categorias = [
            ['slug' => 'todos', 'nombre' => 'Todos los disfraces'],
            ['slug' => 'fantasia', 'nombre' => 'Fantasía & Terror 🧙‍♂️🦇'],
            ['slug' => 'aventuras', 'nombre' => 'Aventuras & Profesiones 🤠🍳'],
            ['slug' => 'animales', 'nombre' => 'Animales & Naturaleza 🐝'],
        ];

        return view('catalogo', [
            'productos' => $productos,
            'categorias' => $categorias,
        ]);
    }

    /**
     * Muestra la página de contacto y ubicación física.
     */
    public function contacto(): View
    {
        return view('contacto');
    }
}
