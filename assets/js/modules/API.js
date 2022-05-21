const usersRoute = '/painel/assets/backend/crud/user/';
const newsRoute = '/painel/assets/backend/crud/noticia/';

const API = () => {
  return {
    user: async (action, init = {}) => {
      
      let res = await (await fetch(usersRoute+action+'.php', init)).json();
      return res;
    },
    news: async (action, init = {}) => {
      
      let res = await (await fetch(newsRoute+action+'.php', init)).json();
      return res;
    }
  };
};

export default API();