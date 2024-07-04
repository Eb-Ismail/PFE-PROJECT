<x-master title="HomePage">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-4 py-4 bg-light border border-dark">
                    <div class="card-body text-center">
                        <h1>Bienvenue sur notre page d'accueil</h1>
                        <h3>Page visitée {{ $compteur }} fois.</h3>
                        <p>Vous pouvez trouver ici des informations utiles sur notre project.</p>
                        <p><a href="#about" class="btn btn-primary">En savoir plus</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="root">
            <!-- Placeholder for dynamic content -->
        </div>
        <div class="row" id="about">
            <div class="col-md-8">
                <div class="card my-4 py-4 bg-light border border-dark">
                    <div class="card-body">
                        <h2>À propos de nous</h2>
                        <p>Contactez-nous pour plus d'informations : <a href="mailto:essaber@gmail.com">essaber@gmail.com</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-master>
