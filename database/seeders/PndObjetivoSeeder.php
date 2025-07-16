<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PndObjetivo;

class PndObjetivoSeeder extends Seeder
{
    public function run(): void
    {
        $objetivos = [
            [
                'numero' => '1',
                'eje' => 'Social',
                'codigo' => 'OBJ-1',
                'nombre' => 'Mejorar las condiciones de vida de la población de forma integral, promoviendo el acceso equitativo a salud, vivienda y bienestar social.',
                'descripcion' => 'Este objetivo busca promover el bienestar de la población mediante el fortalecimiento de sistemas de salud, educación, seguridad social y otros servicios básicos, priorizando a los grupos en situación de vulnerabilidad.'
            ],
            [
                'numero' => '2',
                'eje' => 'Social',
                'codigo' => 'OBJ-2',
                'nombre' => 'Impulsar las capacidades de la ciudadanía con educación equitativa e inclusiva de calidad y promoviendo espacios de intercambio cultural',
                'descripcion' => 'El Objetivo 2 establece políticas y metas tendientes a promover la cultura, consolidar un sistema educativo innovador inclusivo, eficiente, transparente y de calidad en todos los niveles, la creación de entornos libres de violencia en el ámbito educativo y la promoción de la inclusión en las aulas. También aborda el impulso a la investigación y la innovación a través del fortalecimiento de la educación superior, la ampliación en su acceso y calidad.'
            ],
            [
                'numero' => '3',
                'eje' => 'Social',
                'codigo' => 'OBJ-3',
                'nombre' => 'Garantizar la seguridad integral, la paz ciudadana y transformar el sistema de justicia respetando los derechos humanos',
                'descripcion' => 'Este objetivo busca promover una sociedad pacífica e inclusiva, libre de violencia, reconociendo la importancia de proteger la vida de los ciudadanos, recuperar los espacios públicos y promover un desarrollo sostenible, considerando el incremento desmedido de la violencia, la economía criminal y la crisis institucional. Promueve políticas de seguridad con enfoque integral, en el marco del respeto a la ley y los derechos humanos.'
            ],
            [
                'numero' => '4',
                'eje' => 'Desarrollo Económico',
                'codigo' => 'OBJ-4',
                'nombre' => 'Estimular el sistema económico y de finanzas públicas para dinamizar la inversión y las relaciones comerciales',
                'descripcion' => 'Se busca promover el crecimiento económico mediante mayor inversión pública y privada, el fortalecimiento del sistema financiero, la mejora de la confianza en el entorno económico y el fomento a la inversión extranjera. Además, se pretende lograr una gestión eficiente de las finanzas públicas para contribuir al desarrollo sostenible del país.'
            ],
            [
                'numero' => '5',
                'eje' => 'Desarrollo Económico',
                'codigo' => 'OBJ-5',
                'nombre' => 'Fomentar de manera sustentable la producción mejorando los niveles de productividad',
                'descripcion' => 'Este objetivo promueve programas, acciones y estrategias que fomenten la producción sustentable, mejoren el acceso a factores productivos, tecnificación, asociatividad, investigación y desarrollo. Apunta a la distribución igualitaria de los beneficios del desarrollo, respetando los derechos de la naturaleza y el equilibrio entre producción y conservación ambiental.'
            ],
            [
                'numero' => '6',
                'eje' => 'Desarrollo Económico',
                'codigo' => 'OBJ-6',
                'nombre' => 'Incentivar la generación de empleo digno',
                'descripcion' => 'Busca garantizar el bienestar económico y social mediante la creación de empleos dignos. Plantea mejorar las condiciones del mercado laboral, reducir la informalidad y empleo no adecuado, y promover una estrategia laboral con igualdad de oportunidades para todos los ciudadanos, enfocada en justicia social y crecimiento económico sostenible.'
            ],
            [
                'numero' => '7',
                'eje' => 'Infraestructura, Energía y Medio Ambiente',
                'codigo' => 'OBJ-7',
                'nombre' => 'Precautelar el uso responsable de los recursos naturales con un entorno ambientalmente sostenible',
                'descripcion' => 'Es fundamental precautelar el uso responsable de los recursos naturales con el objetivo de preservar la sostenibilidad ambiental. Esto implica promover su conservación y regeneración; y al hacerlo se contribuye a mantener un equilibrio en los ecosistemas, se preserva la biodiversidad y se asegura que las generaciones futuras también puedan beneficiarse de estos recursos. La adopción de tecnologías sostenibles, la gestión eficiente de residuos y la concientización sobre la importancia de cuidar el medio ambiente son pasos clave para lograr un entorno ambientalmente sostenible.'
            ],
            [
                'numero' => '8',
                'eje' => 'Infraestructura, Energía y Medio Ambiente',
                'codigo' => 'OBJ-8',
                'nombre' => 'Impulsar la conectividad como fuente de desarrollo y crecimiento económico y sostenible',
                'descripcion' => 'Se considera a las telecomunicaciones como una parte fundamental del crecimiento de la economía a nivel nacional, por lo que se requieren acciones, a través de las cuales se promueva el desarrollo de capacidades técnicas, a partir de las estrategias que se puedan implementar para la atracción de inversiones en el sector y que generen beneficios para el Estado dentro de su ámbito de aplicación.'
            ],
            [
                'numero' => '9',
                'eje' => 'Institucional',
                'codigo' => 'OBJ-9',
                'nombre' => 'Propender la construcción de un Estado eficiente, transparente y orientado al bienestar social.',
                'descripcion' => 'Este objetivo busca fortalecer la democracia y la confianza de la ciudadanía en las instituciones públicas. Aspira a que estas actúen de manera ética y responsable, tomando decisiones informadas y sujetas a control social. Promueve la participación activa de la ciudadanía en la generación de cambios sociales de manera corresponsable y colaborativa, con el objetivo de mejorar la calidad de vida. Además, busca aprovechar el uso de las tecnologías de la información y comunicación para impulsar la innovación y el emprendimiento.'
            ],
        ];

        foreach ($objetivos as $objetivo) {
            PndObjetivo::create($objetivo);
        }
    }
}
