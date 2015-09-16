<?php

class WP_Badge_Poser_Test extends WP_UnitTestCase 
{

    public function test_shortcodes_badge_poser_exists() 
    {
        $this->assertEquals( shortcode_exists( 'badge-poser' ), true );
    }


    public function test_shortcodes_badge_poser() 
    {

        // stable
        $content = '[badge-poser package="pugx/badge-poser"]';
        $shortcode_content = do_shortcode( $content );
        $this->assertNotEquals( $content, $shortcode_content );

        $dom = $this->getDom($shortcode_content);

        $atag = $dom->query('//a')->item(0);
        $this->assertEquals( $atag->getAttribute('href'), 'https://packagist.org/packages/pugx/badge-poser' );

        $imgtag = $dom->query('//img')->item(0);
        $this->assertEquals( $imgtag->getAttribute('src'), 'https://poser.pugx.org/pugx/badge-poser/v/stable' );

        // unstable
        $content = '[badge-poser package="pugx/badge-poser" version="unstable"]';
        $shortcode_content = do_shortcode( $content );
        $this->assertNotEquals( $content, $shortcode_content );

        $dom = $this->getDom($shortcode_content);

        $atag = $dom->query('//a')->item(0);
        $this->assertEquals( $atag->getAttribute('href'), 'https://packagist.org/packages/pugx/badge-poser' );

        $imgtag = $dom->query('//img')->item(0);
        $this->assertEquals( $imgtag->getAttribute('src'), 'https://poser.pugx.org/pugx/badge-poser/v/unstable' );

        // download
        $content = '[badge-poser package="pugx/badge-poser" download="total"]';
        $shortcode_content = do_shortcode( $content );
        $this->assertNotEquals( $content, $shortcode_content );

        $dom = $this->getDom($shortcode_content);

        $atag = $dom->query('//a')->item(0);
        $this->assertEquals( $atag->getAttribute('href'), 'https://packagist.org/packages/pugx/badge-poser' );

        $imgtag = $dom->query('//img')->item(0);
        $this->assertEquals( $imgtag->getAttribute('src'), 'https://poser.pugx.org/pugx/badge-poser/d/total' );
        
    }

    private function getDom($content)
    {
        $dom = new \DOMDocument();  
        //load the html  
        $dom->loadHTML($content);
        $dom->preserveWhiteSpace = false;
        $xpath = new \DOMXPath($dom);
        if(!empty($xpath)) {
            return $xpath;
        }

        return false;
        
    }

}