<?php
/**
 * Created by PhpStorm.
 * User: tdutrion
 * Date: 03/05/2016
 * Time: 03:19.
 */

namespace Controller;

use W\Controller\Controller;

class BaseController extends Controller
{
    /**
     * Affiche un template.
     *
     * Override the framework class to allow registering another extension
     *
     * @param string $file Chemin vers le template, relatif à app/Views/
     * @param array  $data Données à rendre disponibles à la vue
     */
    public function show($file, array $data = array())
    {
        //incluant le chemin vers nos vues
        $engine = new \League\Plates\Engine(self::PATH_VIEWS);

        //charge nos extensions (nos fonctions personnalisées)
        $engine->loadExtension(new \W\View\Plates\PlatesExtensions());
        $engine->registerFunction('truncate', function ($string, $maxLength) {
            $parts = preg_split('/([\s\n\r]+)/u', $string, null, PREG_SPLIT_DELIM_CAPTURE);
            $parts_count = count($parts);

            $length = 0;
            $last_part = 0;
            for (; $last_part < $parts_count; ++$last_part) {
                $length += strlen($parts[$last_part]);
                if ($length > $maxLength) {
                    break;
                }
            }

            $value = implode(array_slice($parts, 0, $last_part));
            if (strlen($string) > $maxLength) {
                return trim($value).' [...]';
            }

            return $value;
        });
        $engine->registerFunction('highlight', function ($string, $term) {
            return preg_replace("/({$term})/", '<strong class="highlight">$1</strong>', $string);
        });

        $app = getApp();

        // Rend certaines données disponibles à tous les vues
        // accessible avec $w_user & $w_current_route dans les fichiers de vue
        $engine->addData(
            [
                'w_user' => $this->getUser(),
                'w_current_route' => $app->getCurrentRoute(),
            ]
        );

        // Retire l'éventuelle extension .php
        $file = str_replace('.php', '', $file);

        // Affiche le template
        echo $engine->render($file, $data);
        die();
    }
}
