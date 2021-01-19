
  /**
   * Removes all options but the first value in a given select
   * and than selects the only remaining option
   **/
  function removeOptions(select) {
    while (select.options.length > 1) {                
      select.remove(1);
    }
    
    select.value = "";
  }
  
  /**
   * Adds given options to a given select
   **/
  function addOptions(select, options) {
    options.forEach(function(option) {
      select.options.add(new Option(option.name, option.id));
    });
  }
  
  /**
   * Select elements references
   **/
  var carsSelect = document.getElementById('cat1');
  var modelsSelect = document.getElementById('cat2');
  var configurationSelect = document.getElementById('cat3');
  
  /**
   * Updates models
   **/
  function updateModels() {
    var selectedCar = carsSelect.value;
    var options = models.filter(function(model) {
      return model.car === selectedCar;
    });
    
    removeOptions(modelsSelect);
    removeOptions(configurationSelect);
    addOptions(modelsSelect, options);
  }
  
  /**
   * Updates configurations
   */
  function updateConfigurations() {
    var selectedModel = modelsSelect.value;
    var options = configurations.filter(function(configuration) {
      return configuration.model === selectedModel;
    });
    
    removeOptions(configurationSelect);
    addOptions(configurationSelect, options);
  }
  
  /**
   * Adds options to car select
   **/

  addOptions(carsSelect, cars);

  
  
    