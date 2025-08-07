document.addEventListener("DOMContentLoaded", async function () {
  const { value: system } = await Swal.fire({
    title: 'Selecione o sitema que deseja utilizar',
    input: 'select',
    inputOptions: {
      '2': 'MCMV',
      '3': 'PAC',
    },
    inputPlaceholder: '-- Sel sistema --',
    showCancelButton: true,
    inputValidator: (value) => {
      return new Promise((resolve) => {
        if (value === 'oranges') {
          resolve()
        } else {
          resolve('You need to select oranges :)')
        }
      })
    }
  })
});