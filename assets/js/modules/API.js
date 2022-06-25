const EXTERNAL_URL = '/api/';
const URL = '/painel/assets/backend/crud/';

const ROUTE_USERS = 'user/';
const ROUTE_NEWS = 'news/';
const ROUTE_BUYABLE = 'buyable/';
const ROUTE_CARGOS = 'cargos/';
const ROUTE_PERMISSIONS = 'permissoes/';
const ROUTE_RADIO_HORARIOS = 'radio_horarios/';

const API = () => {
  return {
    user: async (action, queryparams = {}, init = {}) => {
      let url = URL+ROUTE_USERS+action+`.php${Object.entries(queryparams).length !== 0 ? '?':''}`;
    
      if (Object.entries(queryparams).length !== 0) {
        for (let param in queryparams) {
          url += `${param}=${queryparams[param]}&`;
        }
        url = url.substring(0, url.length - 1);
      } 

      let res = await (await fetch(url, init)).json();
      return res;
    },
    news: async (action, init = {}) => {
      
      let res = await (await fetch(EXTERNAL_URL+ROUTE_NEWS+action+'.php', init)).json();
      return res;
    },
    buyable: async (action, init = {}) => {
      let res = await (await fetch(EXTERNAL_URL+ROUTE_BUYABLE+action+'.php', init)).json();
      return res;
    },
    cargos: async (action, queryparams = {}, init = {}) => {
      let url = URL+ROUTE_CARGOS+action+`.php${Object.entries(queryparams).length !== 0 ? '?':''}`;
    
      if (Object.entries(queryparams).length !== 0) {
        for (let param in queryparams) {
          url += `${param}=${queryparams[param]}&`;
        }
        url = url.substring(0, url.length - 1);
      } 

      let res = await (await fetch(url, init)).json();
      return res;
    },
    permission: async (action, queryparams = {}, init = {}) => {
      let url = URL+ROUTE_PERMISSIONS+action+`.php${Object.entries(queryparams).length !== 0 ? '?':''}`;
    
      if (Object.entries(queryparams).length !== 0) {
        for (let param in queryparams) {
          url += `${param}=${queryparams[param]}&`;
        }
        url = url.substring(0, url.length - 1);
      } 

      let res = await (await fetch(url, init)).json();
      return res;
    },
    radioHorarios: async (action, queryparams = {}, init = {}) => {
      let url = URL+ROUTE_RADIO_HORARIOS+action+`.php${Object.entries(queryparams).length !== 0 ? '?':''}`;
    
      if (Object.entries(queryparams).length !== 0) {
        for (let param in queryparams) {
          url += `${param}=${queryparams[param]}&`;
        }
        url = url.substring(0, url.length - 1);
      } 

      let res = await (await fetch(url, init)).json();
      return res;
    }
  };
};

export default API();