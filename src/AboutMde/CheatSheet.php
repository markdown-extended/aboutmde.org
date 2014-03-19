<?php

namespace AboutMde;

use \MarkdownExtended\MarkdownExtended;

/**
 * Markdown Extended Cheat Sheet manager
 * 
 * @author Piero Wbmstr <piwi@ateliers-pierrot.fr>
 */
class CheatSheet
{

	/**
	 * Default item data (model for `addItem()` method argument)
	 * 
	 * @var array
	 */
	protected static $_default_item = array(
		'name'			=> 'default',
		'description'	=> '', 			// global description
		'comment'		=> '',			// global comment
		'samples'		=> array(),     // sample items
		'type'			=> '',			// typo(graphic) | bloc(k) | misc(ellaneous)
		'status'		=> 'dev', 		// dev | stable | deprecated | obsolete
		'versions'		=> '*', 		// see <http://semver.org/>
	);

	/**
	 * Items collection
	 * @var array
	 */
	protected $_items;

	/**
	 * Footnotes collection
	 * @var array
	 */
	protected $_footnotes;

	/**
	 * The parser singleton
	 * @var \MarkdownExtended\MarkdownExtended
	 */
	protected $_mde_parser;

	/**
	 * Create a new instance of the object
	 * 
	 * @param \MarkdownExtended\MarkdownExtended $mde_parser
	 */
	public function __construct(MarkdownExtended $mde_parser)
	{
        $this->setMarkdownParser($mde_parser);
        $this->init();
    }

	/**
	 * Initialize the object with an empty collection
	 * 
	 * @return self
	 */
	public function init()
	{
		$this->_items = array();
		$this->_footnotes = array();
		return $this;
	}

// ------------------------------
// Setters / Getters
// ------------------------------

	/**
	 * Set the parser singleton
	 *
	 * @param \MarkdownExtended\MarkdownExtended $parser
	 * @return $this
	 */
	public function setMarkdownParser(MarkdownExtended $parser)
	{
        $this->_mde_parser = $parser;
        return $this;
    }

	/**
	 * Get the parser singleton
	 *
	 * @return \MarkdownExtended\MarkdownExtended
	 */
	public function getMarkdownParser()
	{
        return $this->_mde_parser;
    }

	/**
	 * Add a new item in object collection
	 * 
	 * @param $item array	An array describing the item (based on the model of `self::$_default_item`)
	 * @return self
	 */
	public function addItem(array $item)
	{
		$this->_items[] = array_merge(
			self::$_default_item, $item
		);
		return $this;
	}

	/**
	 * Set the items collection of the object
	 * 
	 * @param $items array	A collection of array describing the items (each item is based on the model of `self::$_default_item`)
	 * @return self
	 */
	public function setItems(array $items)
	{
		$this->init();
		foreach ($items as $i=>$item) {
			$this->addItem($item);
		}
		return $this;
	}

	/**
	 * Get the items collection of the object
	 * 
	 * @return array	The collection of array describing the items (each item is based on the model of `self::$_default_item`)
	 */
	public function getItems()
	{
		return $this->_items;
	}

	/**
	 * Add a new footnotes stack in object collection
	 * 
	 * @param $notes array
	 * @return self
	 */
	public function addFootnotes(array $notes)
	{
        $this->_footnotes = array_merge($this->_footnotes, $notes);
		return $this;
	}

	/**
	 * Get the footnotes of the object
	 * 
	 * @return array
	 */
	public function getFootnotes()
	{
		return $this->_footnotes;
	}

// ------------------------------
// Utilities
// ------------------------------

	/**
	 * Get the items collection filtered by type
	 * 
	 * @param string $type		The type to filter
	 * @return array
	 */
	public function getItemsByType($type)
	{
		return $this->getItemsFiltered('type', $type);
	}
	
	/**
	 * Get the items collection filtered by an entry value
	 * 
	 * @param string|int $filter_var		The variable name to filter for each item
	 * @param string|int|mask $filter_val	The value or a mask to filter the `$item[$filter_var]` value
	 * @return array
	 */
	public function getItemsFiltered($filter_var, $filter_val)
	{
		$_items = array();
		foreach ($this->_items as $i=>$item) {
			if (isset($item[$filter_var])) {
				if (is_string($filter_val)) {
					if ($item[$filter_var]==$filter_val) {
						$_items[] = $item;
					}
				} elseif (is_int($filter_val)) {
					if ((int) $item[$filter_var]==$filter_val) {
						$_items[] = $item;
					}
				} else {
					if (false!==@preg_match($item[$filter_var], $filter_val)) {
						$_items[] = $item;
					}
				}
			}
		}
		return $_items;
	}

    /**
     * Prepare all data adding a "code_parsed" entry to each sample
     *
     * @return self
     */
    public function parseData()
    {
        for ($i=0; $i<count($this->_items); $i++) {
            // long type
            switch ($this->_items[$i]['type']) {
                case 'typo': $this->_items[$i]['long_type'] = 'typographic'; break;
                case 'misc': $this->_items[$i]['long_type'] = 'miscellaneous'; break;
                default: $this->_items[$i]['long_type'] = $this->_items[$i]['type']; break;
            }
            // parsed samples
            $this->_items[$i]['mde_samples'] = array();
            foreach ($this->_items[$i]['samples'] as $si=>$sample) {
                $this->_items[$i]['mde_samples'][$si] =
                    $this->_parseMarkdown($sample);
            }
        }
        return $this;
    }

    /**
     * Parse a string with MD parser
     *
     * @param string $str
     * @return string
     */
    protected function _parseMarkdown($str)
    {
        $return = $this->getMarkdownParser()
            ->transformString($str)
            ->getBody();
        $notes = $this->getMarkdownParser()
            ->getContent()->getNotes();
        if (!empty($notes)) {
            $this->addFootnotes($notes);
        }
        return $return;
    }
    
}

// Endfile
