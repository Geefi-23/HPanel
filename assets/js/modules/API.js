const usersRoute = '/assets/backend/crud/user/';

const API = () => {
  return {
    user: async (action, user) => {
      let init = {
        method: 'POST',
        body: JSON.stringify(user),
        headers: {
          'Content-Type': 'application/json'
        }
      };
      let res = await (await fetch(usersRoute+action+'.php', init)).json();
      return res;
    }
  };
};

export default API();