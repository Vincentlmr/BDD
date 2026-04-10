function colorize() {
  
    let texte = document.getElementById("input").value;

    
    let phrase = texte.replace(/[,.?!:;/'*"()]/g, ' ').split(/\s+/);

    let classicText = "";
    for (let i of phrase) {
        classicText += i + " ";
    }
    document.getElementById("texte").textContent = classicText;


    let textecolorise = "";
    for (let i = 0; i < phrase.length; i++) {
        const mot = phrase[i];
        const red = Math.pow(phrase.length, 2) % 256;
        const green = Math.pow(mot.length, 3) % 256;
        const blue = (10 * i) % 256;
        const color = `rgb(${red}, ${green}, ${blue})`;
        textecolorise += `<span style="color:${color}">${mot}<br></span> `;
    }
    document.getElementById("colorise").innerHTML = textecolorise;
}
