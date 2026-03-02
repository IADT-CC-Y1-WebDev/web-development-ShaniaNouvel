console.log("Hello World!!");

let user = {
    firstName: "Shania",
    lastName: "Molina",
    age: "19",
    hobbies: ["Reading", "Sleeping"],
    friends: [
        {
            firstName: "Salehah",
            lastName: "Usman",
            age: "25",
        },
        {
            firstName: "Cassie",
            lastName: "Ella",
            age: "12",
        }
    ],
};

console.log(user.friends[1].lastName);

let donuts = ["Chocolate", "Jam", "Custard"];

donuts.forEach((donut, i) => {
    // console.log((i + 1) + " " + donut);
    console.log(`Option ${i+1}: ${donut}`)
});
