var hrefNextTrait = (editor) => {
  // Update default link component
  editor.DomComponents.addType('link', {
    model: {
      defaults: {
        content: 'Your New Text Here', // Change 'Click Here' to your desired text
        traits: [
          {
            type: 'link',
            name: 'href',
            label: 'Url',
          },
        ],
      },
    },
  });
};
