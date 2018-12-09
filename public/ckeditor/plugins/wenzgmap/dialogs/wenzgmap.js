/**
 * @license MIT
 *
 * Creato by Webz Ray
 */
CKEDITOR.dialog.add( 'wenzgmapDialog', function( editor ) {

    return {
        title: '구글 맵',
        minWidth: 400,
        minHeight: 75,
        contents: [
            {
                id: 'tab-basic',
                label: 'Basic Settings',
                elements: [
                    {
                        type: 'text',
                        id: 'addressStr',
                        label: '주소를 입력하세요.'
                    },
                    {
                        type: 'text',
                        id: 'mapWidth',
                        label: '지도 너비 (px)',
                        style:'width:25%;',
                    },
                    {
                        type: 'text',
                        id: 'mapHeight',
                        label: '지도 높이 (px)',
                        style: 'width:25%;',
                    }

                ]
            }
        ],
        onOk: function() {
            var dialog = this;
            var url = dialog.getValueOf('tab-basic', 'addressStr').trim();
            var mapWidth = dialog.getValueOf('tab-basic', 'mapWidth').trim();
            var mapHeight = dialog.getValueOf('tab-basic', 'mapHeight').trim();
            var oTag = editor.document.createElement( 'iframe' );
			
            oTag.setAttribute('width', mapWidth);
            oTag.setAttribute('height', mapHeight);
			oTag.setAttribute('src', '//maps.google.com/maps?q=' + url + '&num=1&t=m&ie=UTF8&z=15&output=embed');
			oTag.setAttribute( 'frameborder', '0' );
			oTag.setAttribute('scrolling', 'no');

            editor.insertElement( oTag );
        }
    };
});