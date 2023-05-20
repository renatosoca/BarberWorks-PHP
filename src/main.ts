import "vite/modulepreload-polyfill";

import "./css/style.css";

const findIndexOfX = (): number => {
  const listNumbers: number[] = [13, 15, -18, 29, 3, -4, -9, -10, 3, -7];

  const queryNumber = 13;

  const indice = listNumbers.findIndex(number => number === queryNumber)

  if (indice || indice === 0) {
    return indice
  } else {
    return -1;
  }
}

const response = findIndexOfX();

console.log(response)