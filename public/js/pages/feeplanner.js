var app = angular.module('PPApp',[]);

app.directive('numbersOnly', function() {
   return {
     require: 'ngModel',
     link: function(scope, element, attrs, modelCtrl) {
       modelCtrl.$parsers.push(function (inputValue) {
           if (inputValue == undefined) return '' 
           var transformedInput = inputValue.replace(/[^-?\.0-9]/g, ''); 
           if (transformedInput!=inputValue) {
              modelCtrl.$setViewValue(transformedInput);
              modelCtrl.$render();
           }         

           return transformedInput;         
       });
     }
   };
});

app.directive('numbersNegative', function() {
   return {
     require: 'ngModel',
     link: function(scope, element, attrs, modelCtrl) {
       modelCtrl.$parsers.push(function (inputValue) {
           if (inputValue == undefined) return '' 
           if ( ! /^-\d+\.?\d*$/.test(inputValue)) {
              var transformedInput = inputValue.replace(/[^\.0-9]/g, ''); 
              if (transformedInput!=inputValue && ! /^\d+\.?\d*$/.test(inputValue)) {
	          modelCtrl.$setViewValue('');
              	  modelCtrl.$render();
	      }	
              else if (/^\d+\.?\d*$/.test(inputValue)) {
		  transformedInput = '-' + transformedInput;
	          modelCtrl.$setViewValue(transformedInput);
              	  modelCtrl.$render();
	      }
           }         
           return transformedInput;         
       });
       scope.inputValue = scope.inputValue;
     }
   };
});

function PPCtrl($scope) {
}
