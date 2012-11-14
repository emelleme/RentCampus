jQuery(document).ready(function($) {
var users = ['admin', 'user'];

  var options = {

    inputs: {
     'property': {
       filters: 'required',
       errors: { required: 'A valid Address is required. <br><a href="/listings">Search our Listings</a>' }
     },
     'appEmail': {
        filters: 'required email'
      },
     'firstName': {
        filters: 'required firstName'
      },
      'surname': {
        filters: 'required surname'
      },
      'file': {
        filters: 'extension',
        data: {
          extension: ['jpg']
        }
      },
      'date': {
        filters: 'date'
      },
      'comments': {
        filters: 'min max',
        data: {
          min: 50,
          max: 200
        }
      },
      'states': {
      	filters: 'exclude',
      	data: {
      		exclude: ['default']
      	},
      	errors : {
      		exclude: 'Select a State.'
      	}
      },
      'langs[]': {
        filters: 'min max',
        data: {
          min: 2,
          max: 3
        },
        errors: {
          min: 'Check at least <strong>2</strong> options.',
          max: 'No more than <strong>3</strong> options allowed.'
        }
      }
    }
  };

  var $form = $('#my-form');
  $idealform = $form.idealforms(options);
	
	$('#toStep2').on('click',function(){
		$idealform.nextTab();
	});
  $('#reset').click(function(){
    $idealform.reset().fresh().focusFirst()
  });

$idealform.focusFirst();
});
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='//cdn.zopim.com/?uKjEtQrBwgXSWraCApfYoWWluhu1zDD2';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
