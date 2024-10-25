
// function getMatrix(num){

//   let title = num+' 단\n';
//   for(let i = 1; i<10; i++){
//     title += String(num)+' X '+String(i) + ' = ' + (num * i) + '\n';
//   }

//   return title;
// }

// let result = '';

// for(let i = 2; i<=9; i++){
//   result += getMatrix(i);
//   result += '\n';
// }

// console.log(result);

// let arr = [3,6,37,48,59];

// for ...in 모든 객체를 반복하는 문법, key에 접근
const OBJFORIN = {
  key1 : 'val1'
  ,key2 : 'val2'
};

for(let key in OBJFORIN){
  console.log(OBJFORIN[key]);
}

const OBJ ={key1 : 'val1', key2 : 'val2'}

Object.keys(OBJ).forEach((e,i) => { console.log(OBJ[e])});