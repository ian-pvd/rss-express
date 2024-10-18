<?php
/**
 * RSS Query
 *
 * Retrieve, store, and display an RSS feed.
 */

namespace App;

class RSS_Query {
    protected $xml;
    public $items = [];
    public $categories = [];
    public $category_items = [];

    public function __construct( $url ) {
        // Get XML from the RSS feed url.
        $this->xml = simplexml_load_file( $url );
        if ( $this->xml === false ) {
			throw new \Exception( 'Unable to load RSS feed.' );
		}

        // Parse the XML and store items in object arrays.
        $this->items = $this->parseItems();
        $this->categories = $this->parseCategories();
        $this->category_items = $this->parseCategoryItems();
    }

    private function parseItems() {
        if ( ! empty( $this->items ) ) {
            return $this->items;
        }

        // Build an array of items.
        $xml_items = [];
        $namespaces = $this->xml->getNamespaces(true);

        foreach ( $this->xml->channel->item as $item ) {
            // Get DCMI values.
			$dc = $item->children( $namespaces['dc'] );

            // Parse the XML values.
            $title = (string) $item->title;
            $link = (string) $item->link;
            $description = (string) $item->description;
            $pubDate = date( 'F j, Y', strtotime( (string) $item->pubDate ) );
            $creator = (string) $dc->creator;
            $subject = (string) $dc->subject;

            // Create a key & value pair using the permalink.
            $slug = basename( $link );

            $xml_items[$slug] = [
                'slug' => $slug,
                'title' => $title,
                'link' => $link,
                'description' => $description,
                'pubDate' => $pubDate,
                'creator' => $creator,
                'subject' => $subject,
            ];
        }

        return $xml_items;
    }

    private function parseCategories() {
        if ( ! empty( $this->categories ) ) {
            return $this->categories;
        }

        $xml_categories = [];
        foreach ( $this->items as $item ) {
            $subjects = explode( ',', $item['subject'] );
            foreach ( $subjects as $subject ) {
                $slug = slugify( $subject );
                $xml_categories[$slug] = $subject;
            }
        }

        return array_unique( array_filter( $xml_categories ) );
    }

    private function parseCategoryItems() {
        if ( ! empty( $this->category_items ) ) {
            return $this->category_items;
        }

        $xml_category_items = [];
        foreach ( $this->categories as $slug => $category ) {
            $xml_category_items[$slug] = [];
            foreach ( $this->items as $item ) {
                $subjects = explode( ',', $item['subject'] );
                if ( in_array( $category, $subjects ) ) {
                    $xml_category_items[$slug][] = $item;
                }
            }
        }
        return $xml_category_items;
    }

    public function getTitle() {
        return (string) $this->xml->channel->title ?? 'ProPublica Express';
    }

    public function getLink() {
        return (string) $this->xml->channel->link ?? 'https://www.propublica.org/';
    }

    public function getDescription() {
        return (string) $this->xml->channel->description ?? 'A low-bandwidth version of ProPublica, powered by RSS.';
    }

    public function getImage() {
        $image = [
			'title' => (string) $this->xml->channel->image->title ?? 'ProPublica',
			'url' => (string) $this->xml->channel->image->url ?? 'https://assets.propublica.org/propublica-rss-logo.png',
			'link' => (string) $this->xml->channel->image->link ?? 'https://www.propublica.org/',
		];
		return $image;
	}

    public function getCategoryTitle( $slug ) {
        return $this->categories[$slug] ?? '';
    }

    public function getArticle( $slug ) {
        return $this->items[$slug] ?? [];
    }
}
