let json_content = JSON.parse(document.getElementById('content').value || '[]');

function updateContentTextarea() {
    const contentTextarea = document.getElementById('content');
    contentTextarea.value = JSON.stringify(json_content, null, 2);

}

function renderContent() {
    const contentTextarea = document.getElementById('content');
    json_content = JSON.parse(contentTextarea.value);

    const renderedContentDiv = document.getElementById('rendered_content');
    renderedContentDiv.innerHTML = ''; // Clear previous content
    for(let i = 0; i < json_content.length; i++) {
        const section = json_content[i];
        let sectionElement;

        switch(section.type) {
            case 'paragraph':
                sectionElement = document.createElement('p');
                sectionElement.textContent = section.value;

                break;
            case 'image':
                sectionElement = document.createElement('img');
                sectionElement.src = section.url;
                sectionElement.alt = section.alt;
                if (section.style) {
                    sectionElement.style.cssText = section.style;
                }
                break;
            case 'heading':
                sectionElement = document.createElement(`h${section.level}`);
                sectionElement.textContent = section.value;
                switch(section.level) {
                    case 1:
                        sectionElement.className = 'text-4xl font-bold mt-4';
                        break;
                    case 2:
                        sectionElement.className = 'text-3xl font-bold mt-4';
                        break;
                    case 3:
                        sectionElement.className = 'text-2xl font-bold mt-4';
                        break;
                    default:
                        sectionElement.className = 'text-xl font-bold mt-4';
                }
                break;
            default:
            {
                sectionElement = document.createElement('p');
                // red italics
                sectionElement.className = 'text-red-500 italic';

                sectionElement.textContent = `Unknown block type: ${section.type}`;
                console.warn(`Unknown block type: ${section.type}`);
            }
        }

        if (sectionElement) {
            renderedContentDiv.appendChild(sectionElement);
        }
    }

    // wait for the DOM to update before showing the alert

    alert('Rendered ' + json_content.length + ' blocks.');
}

function addBlock() {
    const blockType = document.getElementById('block_type').value;
    if (!blockType) {
        alert('Please select a block type.');
        return;
    }

    let newBlock = {};

    switch(blockType) {
        case 'text':
            newBlock = { type: 'paragraph', value: '' };
            break;
        case 'image':
            newBlock = { type: 'image', url: '', alt: '', style: '' };
            break;
        case 'heading':
            newBlock = { type: 'heading', value: '', level: 1 };
            break;
        default:
            alert('Invalid block type selected.');
            return;
    }
    json_content.push(newBlock);
    updateContentTextarea();
}

window.addBlock = addBlock;
window.renderContent = renderContent;
window.updateContentTextarea = updateContentTextarea;
