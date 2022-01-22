function readyToGame() {
    const start = document.querySelector('#start');
    const newGame = document.querySelector('#theEnd');

    start.addEventListener('click', startGame);
    newGame.addEventListener("click", goNewGame);

    function startGame() {
        const divGame = document.querySelector('#game');
        const tds = divGame.querySelectorAll('td');
        const timer = divGame.querySelector('#timer');
        const colors = fillArray();
        const obj = createObj();
        let arrTd = [];

        start.disabled = true;
        timerGame();

        for (let td of tds) {
            td.classList.add('active');
            td.addEventListener('click', clickMode);
        }

        function clickMode() {
            this.style.background = obj[this.innerHTML];
            arrTd.push(this);
            matchTd(arrTd);

            if (arrTd.length === 2 && arrTd[0].style.background !== arrTd[1].style.background) {
                notMatch();
            } else if (arrTd[0].style.background === arrTd[1].style.background) {
                getMatch();
            }
        }

        function getMatch() {
            for (let td of tds) {
                td.removeEventListener('click', clickMode);
            }

            const id = setTimeout(function() {
                arrTd[0].style.background = 'white';
                arrTd[1].style.background = 'white';
                arrTd = [];

                for (let td of tds) {
                    if (td.classList.contains('active')) {
                        td.addEventListener('click', )
                    }
                }

                clearTimeout(id);
            }, 300);
        }

        function notMatch() {
            for (let td of tds) {
                td.removeEventListener('click', clickMode);
            }

            const id = setTimeout(function() {
                arrTd[0].style.background = 'white';
                arrTd[1].style.background = 'white';
                arrTd = [];

                for (let td of tds) {
                    if (td.classList.contains('active')) {
                        td.addEventListener('click', clickMode);
                    }
                }

                clearTimeout(id);
            }, 300);
        }

        function createObj() {
            const obj = {};
            const set = new Set();

            while (set.size !== 16) {
                set.add(Math.ceil(Math.random() * 16));
            }

            newObj(set, obj);

            return obj;
        }

        function newObj(arr, obj) {
            let i = 0;

            arr.forEach((elem) => {
                i++;
                obj[i] = colors[elem];
            })
        }

        function matchTd(arr) {
            checkEqual(arr);

            if (arr.length > 2) {
                arr.splice(2);
            }
        }

        function checkEqual(arr) {
            if (arr[0] === arr[1]) {
                arr.splice(1);
            }
        }

        function Win() {
            if (divGame.querySelectorAll('.active').length > 0) {
                return true;
            }
        }

        // let Win = () => divGame.querySelectorAll('.active').length;

        function timerGame() {
            timer.innerHTML = "00:00:000";

            let millisec = 0;
            let seconds = 0;
            let minutes = 0;
            let time = new Date().getTime();

            const id = setInterval(function() {
                millisec = new Date().getTime() - time;

                if (millisec > 999) {
                    time = new Date().getTime();
                    seconds++;
                }

                if (seconds > 59) {
                    seconds = 0;
                    minutes++;
                }

                if (Win()) {
                    clearInterval(id);
                    modalWindow();
                }

                timer.innerHTML = getZero(minutes) + ":" + getZero(seconds) + "." + millisec;
                // timer.innerHTML = `${getZero(minutes)}:${getZero(seconds)}.${millisec};
            }, 1);
        }

        function getZero(num) {
            if (num <= 9) {
                return '0' + num;
            } else {
                return num;
            }
        }
        // const getZero = (num) => num < 10 ? `0${num}` : num;

        function modalWindow() {
            document.querySelector('#winner').style.display = 'grid';
            document.querySelector('#yourTime').innerHTML = 'Time spend: ' + timer.innerHTML;
        }
    }

    function fillArray() {
        return [
            '1',
            'red',
            'red',
            'green',
            'green',
            'blue',
            'blue',
            'black',
            'black',
            'yellow',
            'yellow',
            'hotpink',
            'hotpink',
            'indigo',
            'indigo',
            'magenta',
            'magenta',
        ];
    }

    function goNewGame() {
        const divGame = document.querySelector('#game');
        const timer = divGame.querySelector('#timer');
        const tds = divGame.querySelectorAll('td');

        timer.innerHTML = "00:00.000";
        document.querySelector('#winner').style.display = 'none';
        start.disabled = false;

        for (let td of tds) {
            td.style.background = 'white';
        }
    }
}

document.addEventListener("DOMContentLoaded", readyToGame);
window.onload = readyToGame;
