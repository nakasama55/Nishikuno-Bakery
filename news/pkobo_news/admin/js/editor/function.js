function cleditorExe(){
      $(".cleditor").cleditor({
        width:        'auto', // width not including margins, borders or padding
        height:       200, // height not including margins, borders or padding
        controls:     // controls to add to the toolbar
                    "bold italic underline strikethrough | size " +
                    "color removeformat | bullets numbering | " +
                    "alignleft center alignright | undo redo | " +
                    "rule link unlink | source",
        colors:       // colors in the color popup
          "FFF FCC FC9 FF9 FFC 9F9 9FF CFF CCF FCF " +
          "CCC F66 F96 FF6 FF3 6F9 3FF 6FF 99F F9F " +
          "BBB F00 F90 FC6 FF0 3F3 6CC 3CF 66C C6C " +
          "999 C00 F60 FC3 FC0 3C0 0CC 36F 63F C3C " +
          "666 900 C60 C93 990 090 399 33F 60C 939 " +
          "333 600 930 963 660 060 366 009 339 636 " +
          "000 300 630 633 330 030 033 006 309 303",
        fonts:        // font names in the font popup
          "",
        sizes:        // sizes in the font size popup
          "1,2,3,4,5,6,7",
        styles:       // styles in the style popup
          [["Paragraph", "<p>"], ["Header 1", "<h1>"], ["Header 2", "<h2>"],
            ["Header 3", "<h3>"],  ["Header 4","<h4>"],  ["Header 5","<h5>"],
            ["Header 6","<h6>"]],
        useCSS:       false, // use CSS to style HTML when possible (not supported in ie)
        docType:      // Document type contained within the editor
          '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">',
        docCSSFile:   // CSS file used to style the document contained within the editor
          "",
        bodyStyle:    // style to assign to document body contained within the editor
          "margin:4px; font-size:10pt; cursor:text;background:#ffffff;color:#222222;"
      });
}