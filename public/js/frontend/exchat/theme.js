(() => {
  const body = document.body;
  const toggleBtn = document.getElementById('themeToggle');
  const icon = document.getElementById('themeIcon');
  const THEME_KEY = 'theme';

  const applyTheme = (theme) => {
    body.classList.remove('dark-mode', 'light-mode');
    body.classList.add(`${theme}-mode`);
    if (icon) icon.textContent = theme === 'dark' ? '☀️' : '🌙';
  };

  const getSystemTheme = () =>
    window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';

  const savedTheme = localStorage.getItem(THEME_KEY);
  const initialTheme = savedTheme || getSystemTheme();
  applyTheme(initialTheme);

  // Manual toggle
  toggleBtn?.addEventListener('click', () => {
    const currentTheme = body.classList.contains('dark-mode') ? 'dark' : 'light';
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    applyTheme(newTheme);
    localStorage.setItem(THEME_KEY, newTheme);
  });

  // System theme change listener (only if no manual override)
  window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
    if (!localStorage.getItem(THEME_KEY)) {
      applyTheme(e.matches ? 'dark' : 'light');
    }
  });
})();


(() => {
  const header = document.querySelector('.t-header');
  window.addEventListener('scroll', () => {
    header.classList.toggle('stuck', window.scrollY > 30);
    header.classList.toggle('shrink', window.scrollY > 30);
  });
})();
