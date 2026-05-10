import axios from 'axios';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// You can add more global setup here (e.g., Echo, CSRF token handling)

export default axios;
