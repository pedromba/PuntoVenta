// Apariencia/Appearance Configuration Module

document.addEventListener('DOMContentLoaded', function() {
  initializeAppearanceSettings();
  loadAppearanceSettings();
});

// Initialize Appearance Settings
function initializeAppearanceSettings() {
  // Color Picker - Primary
  const colorPrimarioInput = document.getElementById('colorPrimario');
  const colorPrimarioText = document.getElementById('colorPrimarioText');
  const previewPrimary = document.getElementById('previewPrimary');
  const colorPreviewPrimary = document.getElementById('colorPreviewPrimary');

  if (colorPrimarioInput) {
    colorPrimarioInput.addEventListener('input', function(e) {
      const color = e.target.value;
      colorPrimarioText.value = color;
      if (previewPrimary) previewPrimary.style.backgroundColor = color;
      if (colorPreviewPrimary) colorPreviewPrimary.style.backgroundColor = color;
      document.documentElement.style.setProperty('--primary-color', color);
    });
  }

  // Color Picker - Secondary
  const colorSecundarioInput = document.getElementById('colorSecundario');
  const colorSecundarioText = document.getElementById('colorSecundarioText');
  const previewSecondary = document.getElementById('previewSecundario');
  const colorPreviewSecondary = document.getElementById('colorPreviewSecundario');

  if (colorSecundarioInput) {
    colorSecundarioInput.addEventListener('input', function(e) {
      const color = e.target.value;
      colorSecundarioText.value = color;
      if (previewSecondary) previewSecondary.style.backgroundColor = color;
      if (colorPreviewSecondary) colorPreviewSecundary.style.backgroundColor = color;
      document.documentElement.style.setProperty('--secondary-color', color);
    });
  }

  // Font Family Selector
  const fontFamilySelect = document.getElementById('fontFamily');
  if (fontFamilySelect) {
    fontFamilySelect.addEventListener('change', function(e) {
      const fontFamily = e.target.value;
      document.documentElement.style.setProperty('--font-family', fontFamily);
      document.body.style.fontFamily = fontFamily;
      // Save to localStorage
      localStorage.setItem('selectedFontFamily', fontFamily);
    });
  }

  // Dark Mode Toggle
  const darkModeToggle = document.getElementById('modoDarkMode');
  const darkModeText = document.getElementById('modoDarkModeText');

  if (darkModeToggle) {
    darkModeToggle.addEventListener('change', function(e) {
      const isActive = e.target.checked;
      darkModeText.textContent = isActive ? 'Activado' : 'Desactivado';
      
      if (isActive) {
        document.body.classList.add('dark-mode');
        localStorage.setItem('darkMode', 'true');
      } else {
        document.body.classList.remove('dark-mode');
        localStorage.setItem('darkMode', 'false');
      }
    });

    // Load dark mode preference from localStorage
    const savedDarkMode = localStorage.getItem('darkMode') === 'true';
    if (savedDarkMode) {
      darkModeToggle.checked = true;
      darkModeText.textContent = 'Activado';
      document.body.classList.add('dark-mode');
    }
  }

  // Save Appearance Settings Button
  const appearanceSection = document.getElementById('apariencia');
  if (appearanceSection) {
    const saveBtn = appearanceSection.querySelector('.btn-primary');
    if (saveBtn) {
      saveBtn.addEventListener('click', function(e) {
        e.preventDefault();
        saveAppearanceSettings();
      });
    }
  }
}

// Load Appearance Settings from Server
function loadAppearanceSettings() {
  // This would fetch from server: GET /api/empresa/configuracion/apariencia
  // For now, we'll load from localStorage as fallback
  
  const savedFontFamily = localStorage.getItem('selectedFontFamily');
  const fontFamilySelect = document.getElementById('fontFamily');
  
  if (savedFontFamily && fontFamilySelect) {
    fontFamilySelect.value = savedFontFamily;
    document.body.style.fontFamily = savedFontFamily;
  }
}

// Save Appearance Settings to Server
function saveAppearanceSettings() {
  const colorPrimarioInput = document.getElementById('colorPrimario');
  const colorSecundarioInput = document.getElementById('colorSecundario');
  const fontFamilySelect = document.getElementById('fontFamily');
  const darkModeToggle = document.getElementById('modoDarkMode');

  const configData = {
    color_primario: colorPrimarioInput?.value || '#2563eb',
    color_secundario: colorSecundarioInput?.value || '#2c3e50',
    fuente_familia: fontFamilySelect?.value || 'Poppins, sans-serif',
    modo_oscuro_activado: darkModeToggle?.checked ? 1 : 0
  };

  // Save to localStorage for persistence
  localStorage.setItem('appearanceConfig', JSON.stringify(configData));

  // TODO: Send to backend when API is ready
  // fetch('/api/empresa/configuracion/apariencia', {
  //   method: 'POST',
  //   headers: {
  //     'Content-Type': 'application/json',
  //   },
  //   body: JSON.stringify(configData)
  // })
  // .then(response => response.json())
  // .then(data => {
  //   if (data.success) {
  //     Swal.fire({
  //       icon: 'success',
  //       title: 'Configuración guardada',
  //       text: 'Los cambios de apariencia se han aplicado correctamente',
  //       timer: 2000
  //     });
  //   }
  // })
  // .catch(error => {
  //   console.error('Error saving appearance settings:', error);
  //   Swal.fire({
  //     icon: 'error',
  //     title: 'Error',
  //     text: 'No se pudieron guardar los cambios'
  //   });
  // });

  console.log('Configuración de apariencia a guardar:', configData);

  // Show success notification
  if (typeof Swal !== 'undefined') {
    Swal.fire({
      icon: 'success',
      title: 'Configuración guardada',
      text: 'Los cambios de apariencia se han aplicado correctamente',
      timer: 2000
    });
  } else {
    alert('Configuración guardada correctamente');
  }
}

// Apply saved appearance settings on page load
window.addEventListener('load', function() {
  const savedConfig = localStorage.getItem('appearanceConfig');
  if (savedConfig) {
    try {
      const config = JSON.parse(savedConfig);
      
      // Apply colors
      if (config.color_primario) {
        const colorPrimarioInput = document.getElementById('colorPrimario');
        if (colorPrimarioInput) {
          colorPrimarioInput.value = config.color_primario;
          colorPrimarioInput.dispatchEvent(new Event('input'));
        }
      }
      
      if (config.color_secundario) {
        const colorSecundarioInput = document.getElementById('colorSecundario');
        if (colorSecundarioInput) {
          colorSecundarioInput.value = config.color_secundario;
          colorSecundarioInput.dispatchEvent(new Event('input'));
        }
      }
      
      // Apply font family
      if (config.fuente_familia) {
        const fontFamilySelect = document.getElementById('fontFamily');
        if (fontFamilySelect) {
          fontFamilySelect.value = config.fuente_familia;
          document.body.style.fontFamily = config.fuente_familia;
        }
      }
    } catch (e) {
      console.error('Error loading appearance settings:', e);
    }
  }
});

console.log('Apariencia module loaded');
