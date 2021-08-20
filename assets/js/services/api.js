import axios from 'axios';

export const api = axios.create({
  headers: {'X-Requested-With': 'XMLHttpRequest'}
});

// export {api};
