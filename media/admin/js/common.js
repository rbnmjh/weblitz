// Font size change
function fontSize(fontClass)
{

	theContents = document.getElementById('ntContents');
	theContents.className = fontClass;

}


window.addEvent('domready', function() {
		new Rokmoomenu($E('ul.nav'), {
			bgiframe: false,
			delay: 500,
			animate: {
				props: ['opacity', 'width', 'height'],
				opts: {
					duration:400,
					fps: 100,
					transition: Fx.Transitions.Expo.easeOut
				}
			}
		});
	});

