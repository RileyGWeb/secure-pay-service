const critical = require('critical');

critical.generate(
  {
    base: '../',
    src: 'index.html',
    width: 1300,
    height: 900,
    inline: true
  },
  (err, output) => {
    if (err) {
      console.error(err);
    } else if (output) {
      console.log("Generated critical CSS");
    }
  }
);
