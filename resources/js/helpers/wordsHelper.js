
export const capitalizeAWord = (word) => {
  return (word.charAt(0).toUpperCase() + word.slice(1).toLowerCase()).trim();
}

export const capitalizeWordsInPhrase = (phrase) => {
  if (!phrase) {return ''};
  const words = phrase.split(' ');
  let newPhrase = '';
  if (words.length == 1) {
    return capitalizeAWord(phrase);
  }

  for (let i=0; i<words.length; i++) {
    if (words[i] != " ") {
      newPhrase += capitalizeAWord(words[i]) + " ";
    }
  }

  return newPhrase.trim();
}

export const fullnameInitials = (fullname) => {
  const words = fullname.split(" ");
  try {
    if (words.length > 1) {
      if (words[0].length > 0 && words[1].length > 0) {
        return `${words[0][0].toUpperCase()}${words[1][0].toUpperCase()}`
      } else {
        return ""
      }
    } else {
      if (words[0].length > 1) {
        return `${words[0][0].toUpperCase()}${words[0][1].toUpperCase()}`
      } else {
        return ""
      }
    }
  } catch(ex) {
    console.log(ex)
    return ""
  }

}

export const abbreviation = (phrase) => {
  const words = phrase.split(" ");
  let abbre = "";

  if (words.length < 2) {
    return "";
  } else {
    for (let i=0; i<words.length; i++) {
      abbre += words[i];
    }
  }
  return abbre;
}