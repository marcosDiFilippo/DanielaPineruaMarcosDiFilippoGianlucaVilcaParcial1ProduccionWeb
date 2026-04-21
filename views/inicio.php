<?php include_once('componentes/header.php'); ?>
<link rel="stylesheet" href="assets/css/inicio.css">
<main>

    <!-- Hero -->
    <section class="hero-section">
        <div class="hero-eyebrow">Agencia Da-Vinci</div>
        <h2>La mejor agencia<br>de <span>vehículos</span></h2>
        <p>Explorá nuestra amplia gama de vehículos y encontrá el que mejor se adapte a tus necesidades y presupuesto. El más confiable del mercado, con los mejores precios y calidad.</p>
        <div class="hero-btns">
            <a href="vehiculos.php" class="btn-primary">Ver vehículos</a>
            <?php if (!isset($_SESSION["usuario_id"])): ?>
            <a href="login.php" class="btn-secondary">Iniciar sesión</a>
            <?php endif ?>
        </div>
        <div class="hero-stats">
            <div class="stat-item">
                <span class="stat-number">+50</span>
                <span class="stat-label">Vehículos disponibles</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">+200</span>
                <span class="stat-label">Clientes satisfechos</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">5★</span>
                <span class="stat-label">Calificación promedio</span>
            </div>
        </div>
    </section>

    <!-- Cómo funciona -->
    <div class="como-wrapper">
        <section class="como-section">
            <div class="como-header">
                <p class="como-eyebrow">🚀 Simple y rápido</p>
                <h3>¿Cómo funciona?</h3>
                <p class="como-sub">Encontrá tu auto ideal en tres pasos</p>
            </div>
            <div class="como-grid">
                <div class="paso-card">
                    <div class="paso-numero">01</div>
                    <h4>Explorá el catálogo</h4>
                    <p>Navegá nuestra selección de más de 50 vehículos filtrados por marca, precio y kilometraje.</p>
                </div>
                <div class="paso-divider"></div>
                <div class="paso-card">
                    <div class="paso-numero">02</div>
                    <h4>Elegí tu favorito</h4>
                    <p>Revisá las fichas técnicas, fotos y condiciones de cada vehículo antes de decidirte.</p>
                </div>
                <div class="paso-divider"></div>
                <div class="paso-card">
                    <div class="paso-numero">03</div>
                    <h4>Contactanos</h4>
                    <p>Coordinamos una visita, prueba de manejo y cerramos el trato con total transparencia.</p>
                </div>
            </div>
        </section>
    </div>

    <!-- Autos destacados -->
    <div class="destacados-wrapper">
        <div class="destacados-section">
            <div class="destacados-header">
                <p class="destacados-eyebrow">⭐ Top 3</p>
                <h3>Autos destacados</h3>
                <p class="destacados-sub">Los más icónicos de todos los tiempos</p>
            </div>
            <div class="destacados-grid">

                <div class="car-card">
                    <div class="car-rank rank-gold">1</div>
                    <img src="assets/img/picapiedra.webp" alt="Auto de los Picapiedras" class="car-image">
                    <div class="car-body">
                        <h4>El auto de los Picapiedras</h4>
                        <p class="car-origin">Los Picapiedras · Bedrock, Edad de Piedra</p>
                        <p class="car-desc">Sin motor, sin nafta, sin frenos. Propulsado 100% por los pies descalzos de Fred Picapiedra. Chasis de madera tallada y carrocería de granito puro.</p>
                        <div class="car-tags">
                            <span class="tag">Motor: pies × 2</span>
                            <span class="tag">Combustible: fuerza de voluntad</span>
                            <span class="tag">Frenos: también los pies</span>
                        </div>
                    </div>
                </div>

                <div class="car-card">
                    <div class="car-rank rank-silver">2</div>
                    <img src="assets/img/homero.webp" alt="Auto de Homero Simpson" class="car-image">
                    <div class="car-body">
                        <h4>El auto de Homero Simpson</h4>
                        <p class="car-origin">Los Simpson · Springfield, USA</p>
                        <p class="car-desc">El mítico Pink Sedan. Sobrevivió choques, incendios y caídas a barrancos. Homero lo manejó dormido, comiendo donas y gritando "¡D'oh!" en cada semáforo.</p>
                        <div class="car-tags">
                            <span class="tag">Color: rosa Springfield</span>
                            <span class="tag">Estado: milagrosamente funcional</span>
                            <span class="tag">Pasajeros: 5 + Santa's Little Helper</span>
                        </div>
                    </div>
                </div>

                <div class="car-card">
                    <div class="car-rank rank-bronze">3</div>
                    <img src="assets/img/bumblebee.webp" alt="Bumblebee Camaro" class="car-image">
                    <div class="car-body">
                        <h4>Bumblebee — Camaro Amarillo</h4>
                        <p class="car-origin">Transformers · Planeta Cybertron / Tierra</p>
                        <p class="car-desc">Chevrolet Camaro amarillo que es, en realidad, un robot Autobot de 4 metros. Se transforma en segundos y ha salvado a la humanidad más veces de las que cualquier taller podría cobrar.</p>
                        <div class="car-tags">
                            <span class="tag">Color: amarillo Cybertron</span>
                            <span class="tag">Potencia: robot de guerra</span>
                            <span class="tag">Extra: se transforma solo</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Marcas -->
    <div class="marcas-wrapper">
        <div class="marcas-section">
            <p class="marcas-label">Trabajamos con las mejores marcas</p>
            <div class="marcas-track-wrapper">
                <div class="marcas-track">
                    <span>Toyota</span>
                    <span>Ford</span>
                    <span>Chevrolet</span>
                    <span>BMW</span>
                    <span>Mercedes-Benz</span>
                    <span>Audi</span>
                    <span>Honda</span>
                    <span>Volkswagen</span>
                    <span>Nissan</span>
                    <span>Jeep</span>
                    <!-- duplicado para loop infinito -->
                    <span>Toyota</span>
                    <span>Ford</span>
                    <span>Chevrolet</span>
                    <span>BMW</span>
                    <span>Mercedes-Benz</span>
                    <span>Audi</span>
                    <span>Honda</span>
                    <span>Volkswagen</span>
                    <span>Nissan</span>
                    <span>Jeep</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonios -->
    <div class="testimonios-wrapper">
        <div class="testimonios-section">
            <div class="testimonios-header">
                <p class="testimonios-eyebrow">💬 Lo que dicen</p>
                <h3>Testimonios</h3>
                <p class="testimonios-sub">Clientes que ya encontraron su vehículo ideal</p>
            </div>
            <div class="testimonios-grid">

                <div class="testimonio-card">
                    <div class="testimonio-estrellas">★★★★★</div>
                    <p class="testimonio-texto">"Encontré el auto que buscaba en menos de una semana. El proceso fue súper transparente y el equipo muy profesional."</p>
                    <div class="testimonio-autor">
                        <div class="autor-avatar">MR</div>
                        <div>
                            <p class="autor-nombre">Martín Rodríguez</p>
                            <p class="autor-info">Compró un Toyota Corolla</p>
                        </div>
                    </div>
                </div>

                <div class="testimonio-card">
                    <div class="testimonio-estrellas">★★★★★</div>
                    <p class="testimonio-texto">"Increíble atención desde el primer contacto. Me asesoraron perfectamente y conseguí el mejor precio del mercado."</p>
                    <div class="testimonio-autor">
                        <div class="autor-avatar">SL</div>
                        <div>
                            <p class="autor-nombre">Sofía López</p>
                            <p class="autor-info">Compró un Volkswagen Vento</p>
                        </div>
                    </div>
                </div>

                <div class="testimonio-card">
                    <div class="testimonio-estrellas">★★★★★</div>
                    <p class="testimonio-texto">"La mejor agencia con la que trabajé. Todo claro, sin sorpresas y con financiación accesible. Recomiendo al 100%."</p>
                    <div class="testimonio-autor">
                        <div class="autor-avatar">GF</div>
                        <div>
                            <p class="autor-nombre">Gonzalo Fernández</p>
                            <p class="autor-info">Compró un Ford Ranger</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- CTA final -->
    <section class="cta-section">
        <div class="cta-glow"></div>
        <p class="cta-eyebrow">¿Listo para empezar?</p>
        <h3>Tu próximo auto te está esperando</h3>
        <p>Explorá todo nuestro catálogo y encontrá el vehículo perfecto para vos.</p>
        <div class="cta-btns">
            <a href="vehiculos.php" class="btn-primary">Ver vehículos</a>
            <?php if (!isset($_SESSION["usuario_id"])): ?>
            <a href="login.php" class="btn-secondary">Iniciar sesión</a>
            <?php endif ?>
        </div>
    </section>

</main>
<?php include_once('componentes/footer.php'); ?>