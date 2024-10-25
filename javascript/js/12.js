// console.log(함수명(1, 2));

// function 함수명(하나, 둘) {
//   return 하나 + 둘;
// }

// console.log(함수명(1,2)); //3

// const 함수명 = function(매개변수1, 매개변수2){
//   return 매개변수1 + 매개변수2;
// }

// console.log(함수명(1, 2));


const person = {
    name: ["Bob", "Smith"],
    age: 32,
    gender: "male",
    interests: ["music", "skiing"],
    bio: 'al2',
    greeting: function () {
      alert("Hi! I'm " + this.name[0] + ".");
    },
  };

console.log(person);