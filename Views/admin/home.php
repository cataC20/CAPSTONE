<?php include_once 'Views/templates/header.php'; ?>
<section id="general">
	<div class="container">
		<section>
			<div class="widget">
				<div class="widget-title">
					<div class="widget-title-text">
						Servicios Disponibles
					</div>
					<div class="widget-title-bar"></div>
				</div>
				<div id="servicios" class="widget-body">
					<article>
						<a href="<?php echo BASE_URL . 'organigrama'; ?>">
							<div class="news-thumbnail">
								<img src="<?php echo BASE_URL . 'Assets/img/office.jpg'; ?>" alt="Oficina">
							</div>
							<div class="news-title">
								Conoce tu área
							</div>
							<div class="news-preview">
								<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam pariatur dolores aperiam quos placeat fugiat aut id vero minus corrupti, amet recusandae aliquid, eos doloribus quae at ea tempore! Pariatur.</p>
							</div>
						</a>
					</article>

					<article>
						<a href="">

							<div class="news-thumbnail">
								<img src="<?php echo BASE_URL . 'Assets/img/files.jpg' ?>" />
							</div>
							<div class="news-title">
								Encuentra tus Documentos aca
							</div>
							<div class="news-preview">
								<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit architecto voluptates exercitationem voluptate consectetur eius in quasi amet tempore unde. </p>
							</div>
						</a>
					</article>
					<article>
						<a href="">

							<div class="news-thumbnail">
								<img src="<?php echo BASE_URL . 'Assets/img/solicitud-linea.jpeg' ?>" />
							</div>
							<div class="news-title">
								Realiza una solicitud en linea
							</div>
							<div class="news-preview">
								<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit architecto voluptates exercitationem voluptate consectetur eius in quasi amet tempore unde. </p>
							</div>
						</a>
					</article>
					<article>
						<a href="">

							<div class="news-thumbnail">
								<img src="<?php echo BASE_URL . 'Assets/img/solicitud-linea.jpeg' ?>" />
							</div>
							<div class="news-title">
								Oficina Virtual
							</div>
							<div class="news-preview">
								<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam pariatur dolores aperiam quos placeat fugiat aut id vero minus corrupti, amet recusandae aliquid, eos doloribus quae at ea tempore! Pariatur.</p>
							</div>
						</a>
					</article>
				</div>
			</div>
		</section>
		<aside>
			<div class="widget">
				<div class="widget-title">
					<div class="widget-title-text">
						Noticias
					</div>
					<div class="widget-title-bar"></div>
					<div class="twitter-container">
						<a class="twitter-timeline"
							data-height="400"
							data-theme="light"
							data-chrome="noheader nofooter noborders transparent"
							href="https://twitter.com/avo_transito?ref_src=twsrc%5Etfw">
						</a>
					</div>
				</div>
			</div>
		</aside>	
	</div>
</section>
<div class="carousel-wrapper">
	<div class="carousel-container">
		<div class="carousel-slide">
			<img src="Assets/img/solicitud-linea.jpeg" alt="Imagen 1">
		</div>
		<div class="carousel-slide">
			<img src="Assets/img/img3.jfif" alt="Imagen 2">
		</div>
		<div class="carousel-slide">
			<img src="Assets/img/inaguracion_AVO.jpg" alt="Imagen 3">
		</div>
		<div class="carousel-slide">
			<img src="Assets/img/solicitud-linea.jpeg" alt="Imagen 4">
		</div>
	</div>
</div>
<?php include_once 'Views/templates/footer.php'; ?>