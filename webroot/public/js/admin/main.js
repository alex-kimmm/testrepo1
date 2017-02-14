$(document).ready(function () {

    $(".pick-a-color").pickAColor({
        showSpectrum            : true,
        showSavedColors         : true,
        saveColorsPerElement    : true,
        fadeMenuToggle          : true,
        showAdvanced						: true,
        showBasicColors         : true,
        showHexInput            : true,
        allowBlank							: true,
        inlineDropdown					: true
    });

});