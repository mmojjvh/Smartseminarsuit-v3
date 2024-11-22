const customFonts = [
  {"classname": "arial"},
  {"classname": "playwrite-gb-s"},
  {"classname": "belgrano"},
  {"classname": "bangers"},
  {"classname": "averia-sans-libre"},
  {"classname": "asap"},
  {"classname": "arvo"},
  {"classname": "anton"},
  {"classname": "andika"},
  {"classname": "amatic-sc"},
  {"classname": "almendra"},
  {"classname": "acme"},
  {"classname": "abril-fatface"},
  {"classname": "caveat"},
  {"classname": "rajdhani"},
  {"classname": "lobster"},
  {"classname": "lilita-one"},
  {"classname": "chakra-petch"},
  {"classname": "archivo-black"},
  {"classname": "updock"},
  {"classname": "dancing-script"},
  {"classname": "fira-sans"},
  {"classname": "space-grotesk"},
  {"classname": "dynapuff"},
  {"classname": "pt-serif"},
  {"classname": "bona-nova-sc"},
  {"classname": "bebas-neue "},
  {"classname": "quicksand"},
  {"classname": "oxanium"},
  {"classname": "playfair-display"},
  {"classname": "noto-sans"},
  {"classname": "inter"},
  {"classname": "bitter"},
  {"classname": "black-han-sans"},
  {"classname": "bree-serif"},
  {"classname": "bungee"},
  {"classname": "cabin"},


  {"classname": "cabin-sketch"},
  {"classname": "cardo"},
  {"classname": "coda"},
  {"classname": "cutive-mono"},
  {"classname": "delius-swash-caps"},

  {"classname": "didact-gothic"},
  {"classname": "domine"},
  {"classname": "eb-garamond"},
  {"classname": "eczar"},
  {"classname": "enriqueta"},
  {"classname": "exo"},
  {"classname": "expletus-sans"},
  {"classname": "fanwood-text"},
  {"classname": "fira-mono"},
  {"classname": "fira-sans"},
  {"classname": "gidugu"},
  {"classname": "glegoo"},
  {"classname": "hammersmith-one"},
  {"classname": "inconsolata"},
  {"classname": "istok-web"},
  {"classname": "josefin-sans"},
  {"classname": "josefin-slab"},
  {"classname": "kameron"},
  {"classname": "karla"},
  {"classname": "knewave"},
  {"classname": "lora"},
  {"classname": "lusitana"},
  {"classname": "macondo"},
  {"classname": "merriweather"},
  {"classname": "metamorphous"},
  {"classname": "montserrat"},
  {"classname": "nunito"},
  {"classname": "open-sans"},
  {"classname": "overpass"},
  {"classname": "poppins"},
  {"classname": "raleway"},
  {"classname": "roboto"},
  {"classname": "rubik"},
  {"classname": "sevillana"},
  {"classname": "share-tech-mono"},
  {"classname": "signika"},
  {"classname": "skranji"},
  {"classname": "spectral"},
  {"classname": "tangerine"},
  {"classname": "taviraj"},
  {"classname": "ubuntu"},
  {"classname": "vollkorn"},
  {"classname": "work-sans"},
  {"classname": "yanone-kaffeesatz"},
  {"classname": "zilla-slab"},
  {"classname": "zilla-slab-highlight"},
  {"classname": "montserrat"},
  {"classname": "contrail-one"}
]

function loadCustomFonts(target, previewTarget, callback) {
  
  let field = document.getElementById(target)
  let previewField = document.getElementById(previewTarget)
  
  customFonts.sort((a, b) => a.classname.localeCompare(b.classname)).map((font, index) => {
    let option = document.createElement("option")
    option.value = font.classname
    option.className = font.classname
    option.innerText = font.classname
    option.style = `font-family:Quicksand;`
    field.appendChild(option)
  })
  field.onchange = (e) => {
    previewField.className = e.currentTarget.value
    if(callback) callback(e.currentTarget.value)
  }
  return field
}