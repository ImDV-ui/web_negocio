@extends('layouts.app')

@section('titulo', 'Catálogo de Disfraces para Perros | GuauDisfraces')

@section('contenido')
    <!-- CABECERA DE LA PÁGINA -->
    <section class="page-header">
        <div class="container">
            <span class="badge">Nuestra Colección Completa</span>
            <h1>Catálogo de Disfraces para Perros</h1>
            <p>Descubre nuestros disfraces con telas hipoalergénicas, cierres rápidos y máxima movilidad para tu mascota. Selecciona la talla y añádelo a tu carrito.</p>
        </div>
    </section>

    <!-- CONTENIDO DEL CATÁLOGO -->
    <section class="container catalog-section">
        <!-- Barra de herramientas: Filtros por categoría, Búsqueda y Ordenación -->
        <div class="catalog-toolbar">
            <div class="category-filter-box">
                <span class="filter-label">Filtrar por categoría:</span>
                <ul class="categories-list" id="categoryFilterList">
                    @foreach($categorias as $cat)
                        <li>
                            <button type="button" class="category-pill {{ $cat['slug'] === 'todos' ? 'active' : '' }}" data-category="{{ $cat['slug'] }}">
                                {{ $cat['nombre'] }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="catalog-search-sort">
                <div class="search-input-wrapper">
                    <span class="search-icon">🔍</span>
                    <input type="text" id="catalogSearchInput" class="catalog-search-input" placeholder="Buscar por nombre, temática...">
                </div>

                <div class="sort-wrapper">
                    <label for="catalogSortSelect" class="sort-label">Ordenar:</label>
                    <select id="catalogSortSelect" class="catalog-sort-select">
                        <option value="default">Recomendados</option>
                        <option value="price-asc">Precio: Menor a Mayor</option>
                        <option value="price-desc">Precio: Mayor a Menor</option>
                        <option value="rating-desc">Mejor Valorados</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Contador de resultados -->
        <div class="catalog-results-info">
            <p>Mostrando <strong id="catalogResultsCount">{{ count($productos) }}</strong> disfraces disponibles con entrega rápida 24-48h 🐾</p>
        </div>

        <!-- Cuadrícula de disfraces -->
        <div class="products-grid" id="catalogProductsGrid">
            @foreach($productos as $producto)
                <article class="product-card" 
                         data-id="{{ $producto['id'] }}" 
                         data-category="{{ $producto['categoria_slug'] }}" 
                         data-name="{{ strtolower($producto['nombre']) }}" 
                         data-price="{{ $producto['precio'] }}"
                         data-rating="{{ $producto['rating'] }}">
                    <div class="product-image-container">
                        <img src="{{ asset($producto['imagen']) }}" alt="{{ $producto['nombre'] }}" loading="lazy">
                        <span class="product-tag">{{ $producto['tag'] }}</span>
                    </div>

                    <div class="product-info">
                        <div class="product-meta-header">
                            <span class="product-category-label">{{ $producto['categoria'] }}</span>
                            <div class="product-stars">
                                <span class="stars">★★★★★</span>
                                <span class="rating-val">{{ $producto['rating'] }}</span>
                                <span class="rating-count">({{ $producto['reviews_count'] }})</span>
                            </div>
                        </div>

                        <h3 class="product-title">{{ $producto['nombre'] }}</h3>
                        <p class="product-desc">{{ $producto['descripcion_corta'] }}</p>

                        <!-- Puntos destacados de confección -->
                        <div class="product-micro-specs">
                            <div class="micro-spec-item">
                                <span class="spec-bullet">🧵</span>
                                <span>{{ $producto['material'] }}</span>
                            </div>
                            <div class="micro-spec-item">
                                <span class="spec-bullet">📦</span>
                                <span>{{ $producto['incluye'] }}</span>
                            </div>
                        </div>

                        <!-- Selector de talla interactivo -->
                        <div class="card-size-selector">
                            <span class="size-label">Seleccionar Talla:</span>
                            <div class="size-pills-row">
                                @foreach($producto['tallas'] as $index => $talla)
                                    <button type="button" class="card-size-pill {{ $talla === 'M' || ($loop->first && !in_array('M', $producto['tallas'])) ? 'active' : '' }}" data-size="{{ $talla }}">
                                        {{ $talla }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <div class="product-footer">
                            <div class="price-wrap">
                                <span class="price">{{ number_format($producto['precio'], 2, ',', '.') }} €</span>
                                @if(!empty($producto['precio_anterior']))
                                    <span class="price-old">{{ number_format($producto['precio_anterior'], 2, ',', '.') }} €</span>
                                @endif
                            </div>

                            <div class="card-action-btns">
                                <button type="button" class="btn btn-outline-sm btn-quick-view" onclick="window.tiendaApp.openProductModal({{ $producto['id'] }})" title="Ver detalles y descripción completa">
                                    Detalles
                                </button>
                                <button type="button" class="btn btn-primary btn-sm btn-add-to-cart" data-id="{{ $producto['id'] }}" title="Añadir al carrito">
                                    🛒 Añadir
                                </button>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Mensaje cuando la búsqueda no devuelve resultados -->
        <div id="noResultsMessage" class="catalog-no-results" style="display: none;">
            <span class="no-res-icon">🐶🔍</span>
            <h3>No hemos encontrado ningún disfraz con esos criterios</h3>
            <p>Prueba con otros términos de búsqueda o selecciona la categoría "Todos".</p>
            <button type="button" class="btn btn-secondary btn-sm" id="resetFiltersBtn">Ver todos los disfraces</button>
        </div>

        <!-- Guía de tallas interactiva y completa -->
        <div class="size-guide-card">
            <div class="size-guide-header">
                <span class="size-guide-icon">📏</span>
                <div>
                    <h2>¿Cómo saber la talla exacta de tu perro?</h2>
                    <p>Nuestros disfraces se adaptan con velcro elástico. Para máxima precisión, toma estas 3 medidas con una cinta de costura:</p>
                </div>
            </div>

            <div class="size-guide-grid">
                <div class="size-step-card">
                    <span class="step-num">1</span>
                    <h4>Contorno de Pecho (A)</h4>
                    <p>Mide la zona más ancha de la caja torácica, justo detrás de las patas delanteras. Es la medida más importante.</p>
                </div>
                <div class="size-step-card">
                    <span class="step-num">2</span>
                    <h4>Largo de Espalda (B)</h4>
                    <p>Desde la base del cuello hasta el nacimiento de la cola. Evita que la prenda quede corta o tape la colita.</p>
                </div>
                <div class="size-step-card">
                    <span class="step-num">3</span>
                    <h4>Contorno de Cuello (C)</h4>
                    <p>Mide alrededor del cuello dejando dos dedos de holgura para garantizar total respiración y comodidad.</p>
                </div>
            </div>

            <!-- Tabla orientativa de equivalencias -->
            <div class="size-table-wrapper">
                <table class="size-table">
                    <thead>
                        <tr>
                            <th>Talla</th>
                            <th>Pecho (cm)</th>
                            <th>Espalda (cm)</th>
                            <th>Cuello (cm)</th>
                            <th>Razas y Ejemplos Orientativos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="table-talla-tag">XS</span></td>
                            <td>28 - 35 cm</td>
                            <td>20 - 25 cm</td>
                            <td>20 - 24 cm</td>
                            <td>Chihuahua, Yorkshire Toy, Pomerania mini (1 - 3 kg)</td>
                        </tr>
                        <tr>
                            <td><span class="table-talla-tag">S</span></td>
                            <td>36 - 44 cm</td>
                            <td>26 - 32 cm</td>
                            <td>25 - 30 cm</td>
                            <td>Bichón Maltés, Pinscher, Caniche enano (3 - 6 kg)</td>
                        </tr>
                        <tr>
                            <td><span class="table-talla-tag">M</span></td>
                            <td>45 - 54 cm</td>
                            <td>33 - 40 cm</td>
                            <td>31 - 38 cm</td>
                            <td>Jack Russell, Carlino, Teckel, Schnauzer mini (6 - 11 kg)</td>
                        </tr>
                        <tr>
                            <td><span class="table-talla-tag">L</span></td>
                            <td>55 - 66 cm</td>
                            <td>41 - 50 cm</td>
                            <td>39 - 46 cm</td>
                            <td>Beagle, Bulldog Francés, Cocker Spaniel (11 - 18 kg)</td>
                        </tr>
                        <tr>
                            <td><span class="table-talla-tag">XL</span></td>
                            <td>67 - 78 cm</td>
                            <td>51 - 60 cm</td>
                            <td>47 - 54 cm</td>
                            <td>Border Collie, Bóxer, Golden Retriever (18 - 28 kg)</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="size-tip-box">
                <span class="tip-icon">💡</span>
                <p><strong>Consejo experto de GuauDisfraces:</strong> Si las medidas de tu perro están entre dos tallas, te recomendamos seleccionar siempre la talla superior para que disfrute de mayor soltura y movimiento al caminar.</p>
            </div>
        </div>
    </section>

    <!-- Script de filtrado, búsqueda y ordenación en tiempo real para el catálogo -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categoryPills = document.querySelectorAll('#categoryFilterList .category-pill');
            const searchInput = document.getElementById('catalogSearchInput');
            const sortSelect = document.getElementById('catalogSortSelect');
            const productsGrid = document.getElementById('catalogProductsGrid');
            const resultsCount = document.getElementById('catalogResultsCount');
            const noResultsMsg = document.getElementById('noResultsMessage');
            const resetBtn = document.getElementById('resetFiltersBtn');

            let activeCategory = 'todos';
            let searchQuery = '';
            let currentSort = 'default';

            function filterAndSortProducts() {
                const cards = Array.from(productsGrid.querySelectorAll('.product-card'));
                let visibleCount = 0;

                cards.forEach(card => {
                    const cardCategory = card.getAttribute('data-category');
                    const cardName = card.getAttribute('data-name');
                    const cardText = card.innerText.toLowerCase();

                    const matchesCategory = (activeCategory === 'todos' || cardCategory === activeCategory);
                    const matchesSearch = searchQuery === '' || cardName.includes(searchQuery) || cardText.includes(searchQuery);

                    if (matchesCategory && matchesSearch) {
                        card.style.display = 'flex';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Ordenar elementos visibles
                if (currentSort !== 'default') {
                    const sortedCards = cards.filter(c => c.style.display !== 'none').sort((a, b) => {
                        const priceA = parseFloat(a.getAttribute('data-price'));
                        const priceB = parseFloat(b.getAttribute('data-price'));
                        const ratingA = parseFloat(a.getAttribute('data-rating'));
                        const ratingB = parseFloat(b.getAttribute('data-rating'));

                        if (currentSort === 'price-asc') return priceA - priceB;
                        if (currentSort === 'price-desc') return priceB - priceA;
                        if (currentSort === 'rating-desc') return ratingB - ratingA;
                        return 0;
                    });

                    sortedCards.forEach(card => productsGrid.appendChild(card));
                }

                // Actualizar contador y mensaje de vacío
                if (resultsCount) resultsCount.textContent = visibleCount;
                if (noResultsMsg) noResultsMsg.style.display = visibleCount === 0 ? 'block' : 'none';
            }

            // Click en categorías
            categoryPills.forEach(pill => {
                pill.addEventListener('click', function () {
                    categoryPills.forEach(p => p.classList.remove('active'));
                    this.classList.add('active');
                    activeCategory = this.getAttribute('data-category');
                    filterAndSortProducts();
                });
            });

            // Búsqueda por texto
            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    searchQuery = this.value.trim().toLowerCase();
                    filterAndSortProducts();
                });
            }

            // Cambio de ordenación
            if (sortSelect) {
                sortSelect.addEventListener('change', function () {
                    currentSort = this.value;
                    filterAndSortProducts();
                });
            }

            // Resetear filtros
            if (resetBtn) {
                resetBtn.addEventListener('click', function () {
                    activeCategory = 'todos';
                    searchQuery = '';
                    if (searchInput) searchInput.value = '';
                    categoryPills.forEach(p => {
                        if (p.getAttribute('data-category') === 'todos') p.classList.add('active');
                        else p.classList.remove('active');
                    });
                    filterAndSortProducts();
                });
            }
        });
    </script>
@endsection

