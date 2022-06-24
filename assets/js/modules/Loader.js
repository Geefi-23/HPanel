const Loader = () => {
  const loaderDOM = document.querySelector('#loader-backdrop');
  
  const show = () => {
    loaderDOM.style.display = 'flex';
  };

  const hide = () => {
    loaderDOM.style.display = 'none';
  };

  return {
    show,
    hide
  };
};

export default Loader();