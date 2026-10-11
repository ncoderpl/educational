<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;
use RocketTheme\Toolbox\File\File;
use Symfony\Component\Yaml\Yaml;

/**
 * Class CountViewsPlugin
 * @package Grav\Plugin
 */
class CountViewsPlugin extends Plugin
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }

        // Enable the main events we are interested in
        $this->enable([
            'onPagesInitialized' => ['onPagesInitialized', 0],
            'onPageInitialized' => ['onPageInitialized', 0]
        ]);
    }

    // This loads the existing data into Twig
    public function onPagesInitialized(Event $e)
    {
        $locator = $this->grav['locator'];
        $path = $locator->findResource('user://data', true);
        $path .= DS.static::sanitize($this->grav['config']->get('plugins.count-views.datafile'));

        $data = [];
        try {
            $datafh = File::instance($path);
            $data = Yaml::parse($datafh->content());
            $datafh->free();
        } catch (\Throwable $ex) {
            // Chwilowy problem z plikiem: wyświetl stronę bez liczników
            $data = [];
        }

        // Load count data into a twig variable
        $this->grav['twig']->twig_vars['viewcounts'] = is_array($data) ? $data : [];
    }

    // This increments the counter
    public function onPageInitialized(Event $e)
    {
        $locator = $this->grav['locator'];
        $path = $locator->findResource('user://data', true);
        $path .= DS.static::sanitize($this->grav['config']->get('plugins.count-views.datafile'));

        // Get page route
        $page = $this->grav['page'];
        $route = $page->route();
        if (empty($route)) {
            $route = $this->config->get('plugins.error.routes.404', '/error');
        }

        try {
            $datafh = File::instance($path);

            // Najpierw odczyt, bez lock() (na Windowsie lock blokuje odczyt)
            $data = Yaml::parse($datafh->content());
            if (!is_array($data)) {
                $data = [];
            }

            // Record count
            $data[$route] = ($data[$route] ?? 0) + 1;

            // save() samo zakłada blokadę na czas zapisu
            $datafh->save(Yaml::dump($data));
            $datafh->free();
        } catch (\Throwable $ex) {
            // Chwilowa blokada pliku: pomiń jedno zliczenie zamiast zwracać błąd 500
            return;
        }
    }

    private static function sanitize($fn)
    {
        $fn = trim($fn);
        $fn = str_replace('..', '', $fn);
        $fn = ltrim($fn, DS);
        $fn = str_replace(DS.DS, DS, $fn);
        return $fn;
    }
}