let contentTextarea = document.getElementById('content');
let json_content = JSON.parse(contentTextarea.value || '[]');

function updateContentTextarea() {
    const contentTextarea = document.getElementById('content');
    contentTextarea.value = JSON.stringify(json_content, null, 2);

}

function parseContent() {
    try {
        json_content = JSON.parse(contentTextarea.value);
    } catch (e) {
        alert('Error parsing content: ' + e.message);
    }
}


function renderContent() {
    parseContent();

    const renderedContentDiv = document.getElementById('rendered_content');
    renderedContentDiv.innerHTML = ''; // Clear previous content
    for(let i = 0; i < json_content.length; i++) {
        const section = json_content[i];
        let sectionElement;
        let followingElement;
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
            case 'blockquote':
                sectionElement = document.createElement('blockquote');
                sectionElement.textContent = section.value;
                sectionElement.className = "border-l-4 border-gray-300 pl-4 italic mt-4";

                followingElement = document.createElement('p');
                followingElement.textContent = "— " + section.attr;
                followingElement.className = "text-sm text-gray-500 mt-1";

                break;
            case 'list':
                if (section.ordered) {
                    sectionElement = document.createElement('ol');
                } else {
                    sectionElement = document.createElement('ul');
                }
                for (const item of section.value) {
                    const li = document.createElement('li');
                    li.textContent = item;
                    sectionElement.appendChild(li);
                }
                break;
            case 'pre':
                sectionElement = document.createElement('pre');
                sectionElement.textContent = section.value;
                sectionElement.className = "bg-gray-100 p-4 rounded mt-4 overflow-x-auto";
                break;
            case 'html':
                sectionElement = document.createElement('div');
                sectionElement.innerHTML = section.value;
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
        if (followingElement) {
            renderedContentDiv.appendChild(followingElement);
        }
    }

    // wait for the DOM to update before showing the alert

    alert('Rendered ' + json_content.length + ' blocks.');
}

function addBlock() {
    parseContent();
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
        case 'blockquote':
            newBlock = { type: 'blockquote', value: '', attr: '' };
            break;
        case 'list':
            newBlock = { type: 'list', value: [], ordered: false };
            break;
        case 'pre':
            newBlock = { type: 'pre', value: '', language: '' };
            break;
        case 'html':
            newBlock = { type: 'html', value: '' };
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
