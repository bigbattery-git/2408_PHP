// 원본 보존 및 오름차순 정렬

const ARR1 = [6,3,5,8,72,3,7,5,100,80,40];

let copy = [...ARR1];

copy.sort((a,b) => a - b);

console.log (`question1 => original : ${ARR1} / copy : ${copy}`);

let copy2 = [...copy];
let copy3 = [...copy];

for(let i = 0; i < copy2.length; i++){
  let target = copy2[i];
  let count = 0;
  for(let j = 0; j < copy2.length; j++ ){
    if(target === copy2[j]){
      count += 1;
      if(count > 1){
        copy2.splice(j, 1);
      }
    }
  }
}

let result = [];
copy3.forEach((a, i) => {
  if(!(result.includes(a))) 
    result.push(a);
})

let result2 = copy.filter((a, i) => copy.indexOf(a) === i);

console.log(`no dup : ${copy2}`);

console.log(`더 쉬운 no dup : ${result}`);

console.log (`더더더 쉬운 no dup : ${result2}`);


// 짝수 홀수 분리 후 각각 새로운 배열 만들기 

const ARR2 = [5,7,3,4,5,1,2];
let odd = [];
let even = [];
ARR2.forEach((a,i)=>{
  if(a%2===0){
    even[even.length]=a;
  } else {
    odd[odd.length]=a;
  }
});
console.log(`question2 => odd : ${odd} / even : ${even}`);