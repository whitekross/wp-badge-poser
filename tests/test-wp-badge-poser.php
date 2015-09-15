<?php

class WP_Badge_Poser_Test extends WP_UnitTestCase 
{

    public function test_shortcodes_badge_poser_exists() 
    {
        $this->assertEquals( shortcode_exists( 'badge-poser' ), true );
    }


    public function test_shortcodes_badge_poser() 
    {

        $content = '[badge-poser package="pugx/badge-poser"]';
        $shortcode_content = do_shortcode( $content );
        $this->assertNotEquals( $content, $shortcode_content );
        // HTML Matcher
        $matcher = [
          'tag'  => 'img',
          'attributes'  => 
                [
                'src' => 'https://poser.pugx.org/pugx/badge-poser/v/stable',
                'alt' => 'Latest stable version of pugx/badge-poser'
                ],
          'parent'      => ['tag' => 'a', 'attributes' => ['href' => 'https://packagist.org/packages/pugx/badge-poser']]
        ];
        $this->assertTag($matcher, $shortcode_content);

        $content = '[badge-poser package="pugx/badge-poser" version="unstable"]';
        $shortcode_content = do_shortcode( $content );
        $this->assertNotEquals( $content, $shortcode_content );
        // HTML Matcher
        $matcher = [
          'tag'  => 'img',
          'attributes'  => 
                [
                'src' => 'https://poser.pugx.org/pugx/badge-poser/v/unstable',
                'alt' => 'Latest unstable version of pugx/badge-poser'
                ],
          'parent'      => ['tag' => 'a', 'attributes' => ['href' => 'https://packagist.org/packages/pugx/badge-poser']]
        ];
        $this->assertTag($matcher, $shortcode_content);

        $content = '[badge-poser package="pugx/badge-poser" download="total"]';
        $shortcode_content = do_shortcode( $content );
        $this->assertNotEquals( $content, $shortcode_content );
        // HTML Matcher
        $matcher = [
          'tag'  => 'img',
          'attributes'  => 
                [
                'src' => 'https://poser.pugx.org/pugx/badge-poser/d/total',
                'alt' => 'total downloads for pugx/badge-poser'
                ],
          'parent'      => ['tag' => 'a', 'attributes' => ['href' => 'https://packagist.org/packages/pugx/badge-poser']]
        ];
        $this->assertTag($matcher, $shortcode_content);
        
    }
}