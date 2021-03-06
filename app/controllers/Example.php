<?php
/**
 * Examples Controller
 * Multiple examples of how you can use erdiko.  It includes some simple use cases.
 *
 * @category    app
 * @package     Example
 * @copyright   Copyright (c) 2014, Arroyo Labs, www.arroyolabs.com
 * @author      John Arroyo, john@arroyolabs.com
 */
namespace app\controllers;

use Erdiko;
use erdiko\core\Config;

/**
 * Example Controller Class
 */
class Example extends \erdiko\core\Controller
{
    /** Before */
    public function _before()
    {
        $this->setThemeName('bootstrap');
        $this->prepareTheme();
    }

    /** Get Hello */
    public function getHello()
    {
        $this->setTitle('Hello World');
        $this->setContent("Hello World");
    }

    /**
     * Homepage Action (index)
     */
    public function getIndex()
    {
        // Add page data
        $this->setTitle('Examples');
        $this->addView('examples/index');
    }

    /**
     * Get baseline, the simplest page around town
     */
    public function getBaseline()
    {
        $this->setContent("The simplest page possible");
        // $test = Erdiko::log("This is my log message."); // testing the logger
    }

    /**
     * Get full page
     */
    public function getFullpage()
    {
        $this->setThemeTemplate('fullpage');
        $this->setContent("This is a fullpage layout (sans header/footer)");
    }

    /**
     * Get set view
     */
    public function getSetview()
    {
        $this->setTitle('Example: Page with a single view');
        $this->addView('examples/setview');
    }

    /**
     * Get multiple views
     */
    public function getSetmultipleviews()
    {
        $this->setTitle('Example: Page with multiple views');

        // Include multiple views directly
        $content = $this->getView('examples/one');
        $content .= $this->getView('examples/two');
        $content .= $this->getView('examples/three');

        $this->setContent($content);
    }

    /**
     * Get multiple views at
     */
    public function getSetmultipleviewsAlt()
    {
        $this->setTitle('Example: Page with multiple views (alt)');

        // Add multiple views using api (better approach)
        $this->addView('examples/one');
        $this->addView('examples/two');
        $this->addView('examples/three');
    }

    /**
     * Get view2
     */
    public function getSetview2()
    {
        // Include multiple views indirectly
        $page = array(
            'content' => array(
                'view1' => $this->getView('examples/one'),
                'view2' => $this->getView('examples/two'),
                'view3' => $this->getView('examples/three')
                )
            );

        $this->setTitle('Example: Multiple views take 2');
        $this->addView('examples/setview2', $page);
    }

    /**
     * Slideshow Action
     */
    public function getCarousel()
    {
        // Add page data
        $this->setTitle('Example: Carousel');
        $this->addView('examples/carousel');

        // Inject the carousel js code
        $this->getResponse()->getTheme()->addJs('/themes/bootstrap/js/carousel.js');
    }

    /**
     * Get php info
     */
    public function getPhpinfo()
    {
        phpinfo();
        exit;
    }

    /**
     * Get Mark Up
     *
     * @usage This is an alternate way to add page content data
     * You can load a view directly into the content.
     * This is not the preferred way to add content.
     * Use the addView() method or a Layout when possible.
     */
    public function getMarkup()
    {
        $this->setTitle('Example Mark-Up');
        $this->setContent($this->getView('examples/markup'));
    }

    /**
     * Get two column
     */
    public function getTwocolumn()
    {
        // Set columns directly using a layout
        $columns = array(
            'one' => $this->getView('examples/one'),
            'two' => $this->getView('examples/two') . $this->getView('examples/three')
            );
        
        $this->setTitle('Example: 2 Column Layout Page');
        $this->setContent($this->getLayout('2column', $columns));
    }

    /**
     * Get three column
     */
    public function getThreecolumn()
    {
        // Set each column using a layout
        $columns = array(
            'one' => $this->getView('examples/one'),
            'two' => $this->getView('examples/two'),
            'three' => $this->getView('examples/three')
            );
        
        $this->setTitle('Example: 3 Column Layout Page');
        $this->setContent($this->getLayout('3column', $columns));
    }

    /**
     * Get grid
     */
    public function getGrid()
    {
        $data = array(
            'columns' => 4,
            'count' => 12
            );
        
        $this->setTitle('Example: Grid');
        $this->setContent($this->getLayout('grid/default', $data));
    }

    /* Footer */

    /**
     * Get Config
     */
    public function getConfig()
    {
        $data = \Erdiko::getConfig("application/default");
        $this->setTitle('Shopify: Customers');
        $this->setContent($this->getLayout('json', $data));
    }

    /**
     * Get Exception
     */
    public function getException()
    {
        $this->setContent($this->getLayout('notExist', null));
    }

    /**
     * Get About
     */
    public function getAbout()
    {
        $this->setTitle("About");

        $data = \Erdiko::getConfig("application/default");
        $this->setContent("<h2>{$data['site']['full_name']}</h2>
        <h3>{$data['site']['tagline']}</h3> <p>{$data['site']['description']}</p>");
    }
}
