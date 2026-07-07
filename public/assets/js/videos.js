const video = document.getElementById('meuVideo');
        const playPromise = video.play();

        if (playPromise !== undefined) {
            playPromise.catch(error => {
                console.log("Autoplay com som bloqueado. Aguardando interação do usuário...");
                
                const iniciarVideo = () => {
                    video.play();
                    document.removeEventListener('click', iniciarVideo);
                    document.removeEventListener('touchstart', iniciarVideo);
                };

                document.addEventListener('click', iniciarVideo);
                document.addEventListener('touchstart', iniciarVideo);
            });
        }