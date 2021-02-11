const app = () => {

    toggleComponent()

}

const toggleComponent = () => {

    const link = document.querySelector('#toggleComponent')
    const theComponent = document.querySelector('#the-component')

    link.addEventListener('click',()=>{
       theComponent.classList.toggle('hide-the-component')
    });

}

app();