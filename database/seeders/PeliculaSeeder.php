<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelicula;
use App\Services\TmdbService; // Importar el servicio TMDb
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http; // Necesario para Http::get()

class PeliculaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // CORRECCIÓN CLAVE: Resolvemos el servicio TMDb directamente aquí
        $tmdbService = app(TmdbService::class);
        
        $peliculasData = [
            [
                'titulo' => 'Blade Runner 2049',
                'director' => 'Denis Villeneuve',
                'genero' => 'Ciencia Ficción',
                'fecha_estreno' => '2017-10-06',
                'duracion' => 164,
                'clasificacion' => '+16',
                'actores' => 'Ryan Gosling, Harrison Ford, Ana de Armas',
            ],
            [
                'titulo' => 'Parásitos',
                'director' => 'Bong Joon-ho',
                'genero' => 'Thriller Social',
                'fecha_estreno' => '2019-10-25',
                'duracion' => 132,
                'clasificacion' => '+16',
                'actores' => 'Song Kang-ho, Choi Woo-shik, Park So-dam',
            ],
            [
                'titulo' => 'Dune',
                'director' => 'Denis Villeneuve',
                'genero' => 'Ciencia Ficción',
                'fecha_estreno' => '2021-10-22',
                'duracion' => 155,
                'clasificacion' => '+12',
                'actores' => 'Timothée Chalamet, Rebecca Ferguson, Zendaya',
            ],
            [
                'titulo' => 'Origen',
                'director' => 'Christopher Nolan',
                'genero' => 'Thriller',
                'fecha_estreno' => '2010-08-06',
                'duracion' => 148,
                'clasificacion' => '+12',
                'actores' => 'Leonardo DiCaprio, Joseph Gordon-Levitt, Elliot Page',
            ],
            [
                'titulo' => 'Interstellar',
                'director' => 'Christopher Nolan',
                'genero' => 'Ciencia Ficción',
                'fecha_estreno' => '2014-11-07',
                'duracion' => 169,
                'clasificacion' => '+12',
                'actores' => 'Matthew McConaughey, Anne Hathaway, Jessica Chastain',
            ],
            [
                'titulo' => 'El Padrino',
                'director' => 'Francis Ford Coppola',
                'genero' => 'Crimen',
                'fecha_estreno' => '1972-03-24',
                'duracion' => 175,
                'clasificacion' => '+18',
                'actores' => 'Marlon Brando, Al Pacino, James Caan',
            ],
            [
                'titulo' => 'Joker',
                'director' => 'Todd Phillips',
                'genero' => 'Drama',
                'fecha_estreno' => '2019-10-04',
                'duracion' => 122,
                'clasificacion' => '+18',
                'actores' => 'Joaquin Phoenix, Robert De Niro, Zazie Beetz',
            ],
            [
                'titulo' => 'El club de la lucha',
                'director' => 'David Fincher',
                'genero' => 'Drama',
                'fecha_estreno' => '1999-10-15',
                'duracion' => 139,
                'clasificacion' => '+18',
                'actores' => 'Brad Pitt, Edward Norton, Helena Bonham Carter',
            ],
            [
                'titulo' => 'Pulp Fiction',
                'director' => 'Quentin Tarantino',
                'genero' => 'Crimen',
                'fecha_estreno' => '1994-10-14',
                'duracion' => 154,
                'clasificacion' => '+18',
                'actores' => 'John Travolta, Uma Thurman, Samuel L. Jackson',
            ],
            [
                'titulo' => 'El viaje de Chihiro',
                'director' => 'Hayao Miyazaki',
                'genero' => 'Animación',
                'fecha_estreno' => '2001-07-20',
                'duracion' => 125,
                'clasificacion' => 'Apta para todos los publicos',
                'actores' => 'Rumi Hiiragi, Miyu Irino, Mari Natsuki',
            ],
            [
                'titulo' => 'Matrix',
                'director' => 'Lana Wachowski',
                'genero' => 'Ciencia Ficción',
                'fecha_estreno' => '1999-03-31',
                'duracion' => 136,
                'clasificacion' => '+12',
                'actores' => 'Keanu Reeves, Laurence Fishburne, Carrie-Anne Moss',
            ],
            [
                'titulo' => 'Gladiator',
                'director' => 'Ridley Scott',
                'genero' => 'Acción',
                'fecha_estreno' => '2000-05-05',
                'duracion' => 155,
                'clasificacion' => '+16',
                'actores' => 'Russell Crowe, Joaquin Phoenix, Connie Nielsen',
            ],
            [
                'titulo' => 'Gran Torino',
                'director' => 'Clint Eastwood',
                'genero' => 'Drama',
                'fecha_estreno' => '2008-12-12',
                'duracion' => 116,
                'clasificacion' => '+16',
                'actores' => 'Clint Eastwood, Bee Vang, Ahney Her',
            ],
            [
                'titulo' => 'Whiplash',
                'director' => 'Damien Chazelle',
                'genero' => 'Drama',
                'fecha_estreno' => '2014-10-10',
                'duracion' => 106,
                'clasificacion' => '+12',
                'actores' => 'Miles Teller, J.K. Simmons, Paul Reiser',
            ],
        ];

        // MÉTODOLOGÍA CORREGIDA: Llamamos al método privado para crear cada película
        foreach ($peliculasData as $data) {
            $this->seedPeliculaWithTmdb($data, $tmdbService);
        }
    }

    /**
     * Crea una película, la guarda en DB y descarga su póster de TMDb.
     * Esta función contiene la lógica de descarga que el usuario quiere reutilizar.
     */
    private function seedPeliculaWithTmdb(array $data, TmdbService $tmdbService): void
    {
        // 1. Crear la película SIN portada
        $pelicula = Pelicula::create($data);
        
        // 2. Intentar buscar y descargar la portada de TMDb
        try {
            $searchResults = $tmdbService->searchMovie($data['titulo']);

            if (!empty($searchResults['results'])) {
                $bestMatch = $searchResults['results'][0];
                $posterPath = $bestMatch['poster_path'];

                if ($posterPath) {
                    // Obtener la URL completa de la imagen
                    $imageUrl = $tmdbService->getImageUrl($posterPath);

                    // Descargar el contenido binario de la imagen
                    $response = Http::get($imageUrl);

                    if ($response->successful()) {
                        $imageContents = $response->body();
                        // Guardar el archivo en storage/app/public/portadas/
                        $filename = 'portadas/' . $pelicula->id . '.jpg';
                        Storage::disk('public')->put($filename, $imageContents);

                        // 3. Actualizar la película con la ruta de la portada
                        $pelicula->portada = $filename;
                        $pelicula->save();
                        
                        $this->command->info("Portada descargada para: " . $data['titulo']);

                    } else {
                        $this->command->warn("Fallo al descargar la portada de TMDb para: " . $data['titulo'] . ". Código de estado: " . $response->status());
                    }
                }
            }
        } catch (\Exception $e) {
            $this->command->error("Error de TMDb/Descarga para {$data['titulo']}: " . $e->getMessage());
        }
    }
}