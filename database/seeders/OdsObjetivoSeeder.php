<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OdsObjetivo;

class OdsObjetivoSeeder extends Seeder
{
    public function run(): void
    {
        $objetivos = [
            ['codigo' => 'ODS-1',  'nombre' => 'Fin de la pobreza', 'descripcion' => 'Poner fin a la pobreza en todas sus formas y en todo el mundo.'],
            ['codigo' => 'ODS-2',  'nombre' => 'Hambre cero', 'descripcion' => 'Poner fin al hambre, lograr la seguridad alimentaria y la mejora de la nutrición y promover la agricultura sostenible.'],
            ['codigo' => 'ODS-3',  'nombre' => 'Salud y bienestar', 'descripcion' => 'Garantizar una vida sana y promover el bienestar para todos en todas las edades.'],
            ['codigo' => 'ODS-4',  'nombre' => 'Educación de calidad', 'descripcion' => 'Garantizar una educación inclusiva, equitativa y de calidad y promover oportunidades de aprendizaje durante toda la vida para todos.'],
            ['codigo' => 'ODS-5',  'nombre' => 'Igualdad de género', 'descripcion' => 'Lograr la igualdad entre los géneros y empoderar a todas las mujeres y las niñas.'],
            ['codigo' => 'ODS-6',  'nombre' => 'Agua limpia y saneamiento', 'descripcion' => 'Garantizar la disponibilidad de agua y su gestión sostenible y el saneamiento para todos.'],
            ['codigo' => 'ODS-7',  'nombre' => 'Energía asequible y no contaminante', 'descripcion' => 'Garantizar el acceso a una energía asequible, segura, sostenible y moderna para todos.'],
            ['codigo' => 'ODS-8',  'nombre' => 'Trabajo decente y crecimiento económico', 'descripcion' => 'Promover el crecimiento económico sostenido, inclusivo y sostenible, el empleo pleno y productivo y el trabajo decente para todos.'],
            ['codigo' => 'ODS-9',  'nombre' => 'Industria, innovación e infraestructura', 'descripcion' => 'Construir infraestructuras resilientes, promover la industrialización inclusiva y sostenible y fomentar la innovación.'],
            ['codigo' => 'ODS-10', 'nombre' => 'Reducción de las desigualdades', 'descripcion' => 'Reducir la desigualdad en los países y entre ellos.'],
            ['codigo' => 'ODS-11', 'nombre' => 'Ciudades y comunidades sostenibles', 'descripcion' => 'Lograr que las ciudades y los asentamientos humanos sean inclusivos, seguros, resilientes y sostenibles.'],
            ['codigo' => 'ODS-12', 'nombre' => 'Producción y consumo responsables', 'descripcion' => 'Garantizar modalidades de consumo y producción sostenibles.'],
            ['codigo' => 'ODS-13', 'nombre' => 'Acción por el clima', 'descripcion' => 'Adoptar medidas urgentes para combatir el cambio climático y sus efectos.'],
            ['codigo' => 'ODS-14', 'nombre' => 'Vida submarina', 'descripcion' => 'Conservar y utilizar sosteniblemente los océanos, los mares y los recursos marinos para el desarrollo sostenible.'],
            ['codigo' => 'ODS-15', 'nombre' => 'Vida de ecosistemas terrestres', 'descripcion' => 'Gestionar sosteniblemente los bosques, luchar contra la desertificación, detener e invertir la degradación de las tierras y detener la pérdida de biodiversidad.'],
            ['codigo' => 'ODS-16', 'nombre' => 'Paz, justicia e instituciones sólidas', 'descripcion' => 'Promover sociedades pacíficas e inclusivas para el desarrollo sostenible, facilitar el acceso a la justicia para todos y construir instituciones eficaces, responsables e inclusivas a todos los niveles.'],
            ['codigo' => 'ODS-17', 'nombre' => 'Alianzas para lograr los objetivos', 'descripcion' => 'Fortalecer los medios de implementación y revitalizar la Alianza Mundial para el Desarrollo Sostenible.'],
        ];

        foreach ($objetivos as $objetivo) {
            OdsObjetivo::create($objetivo);
        }
    }
}
