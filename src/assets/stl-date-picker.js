(function(global){'use strict';
var registry=new Map();
function emit(element,name,detail){element.dispatchEvent(new CustomEvent('stl:date-'+name,{bubbles:true,detail:detail||{}}));}
function apply(input,options){options=options||{}; if(options.min)input.min=options.min;if(options.max)input.max=options.max;if(options.step)input.step=options.step;if(options.locale)input.lang=options.locale;if(options.theme)input.dataset.stlTheme=options.theme;if(options.labels&&options.labels.input)input.setAttribute('aria-label',options.labels.input);input.addEventListener('change',function(){emit(input,'change',{value:input.value,date:input.valueAsDate});});emit(input,'ready',{value:input.value});return input;}
global.StlDatePicker={
create:function(id,options){var input=document.getElementById(id);if(!input)throw new Error('Date input not found: '+id);if(registry.has(input))return registry.get(input);registry.set(input,apply(input,options));return input;},
createRange:function(id,options){var root=document.getElementById(id);if(!root)throw new Error('Date range not found: '+id);var inputs=root.querySelectorAll('input[type="date"]');if(inputs.length!==2)return root;apply(inputs[0],options);apply(inputs[1],options);var sync=function(event){if(inputs[0].value)inputs[1].min=inputs[0].value;if(inputs[1].value)inputs[0].max=inputs[1].value;emit(root,'range-change',{start:inputs[0].value,end:inputs[1].value,source:event&&event.target});};inputs[0].addEventListener('change',sync);inputs[1].addEventListener('change',sync);if(options&&options.theme)root.dataset.stlTheme=options.theme;sync();return root;},
on:function(element,name,callback){element.addEventListener('stl:date-'+name,callback);return function(){element.removeEventListener('stl:date-'+name,callback);};}
};}(window));
