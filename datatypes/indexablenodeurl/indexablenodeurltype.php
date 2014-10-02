<?php

/**
 * @package index_node_url
 * @class   indexableNodeURLType
 * @author  Serhey Dolgushev <dolgushev.serhey@gmail.com>
 * @date    02 Oct 2014
 * */
class indexableNodeURLType extends eZDataType {

    const DATA_TYPE_STRING = 'indexablenodeurl';

    public function __construct() {
        $this->eZDataType( self::DATA_TYPE_STRING, ezpI18n::tr( 'extension/index_node_url', 'Indexable Node URL' ) );
    }

    function isIndexable() {
        return true;
    }

    public function metaData( $contentObjectAttribute ) {
        $object = $contentObjectAttribute->attribute( 'object' );
        if( $object instanceof eZContentObject === false ) {
            return;
        }

        $node = $object->attribute( 'main_node' );
        if( $node instanceof eZContentObjectTreeNode === false ) {
            return;
        }

        $url  = $node->attribute( 'url_alias' );
        $text = str_replace( array( '/', eZCharTransform::wordSeparator() ), ' ', $url );
        return $text;
    }

}

eZDataType::register( indexableNodeURLType::DATA_TYPE_STRING, 'indexableNodeURLType' );
