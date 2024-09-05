const text = document.querySelector(".sec-text");

const textLoad = () => {
    setTimeout(() => {
        text.textContent = "안녕하세요 여러분~ 😁 우리는!";
    }, 0);
    setTimeout(() => {
        text.textContent = "보안을 사랑하는 사람들이 모여 활동하는";
    }, 4100);
    setTimeout(() => {
        text.textContent = "3조 보안의 역사 팀 입니다! 🔐";
    }, 8150); //1s = 1000 milliseconds
}

textLoad();
setInterval(textLoad, 12000);