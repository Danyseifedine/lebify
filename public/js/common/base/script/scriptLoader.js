const resourceCache = new Map();

function loadScripts(resources, defaultTargetElement = document.body) {
    const loadResource = (resource, resolve, reject) => {
        let element;
        const targetElement = resource.targetElement || defaultTargetElement;

        switch (resource.type) {
            case 'script':
                element = document.createElement('script');
                element.src = resource.path;
                element.onload = resolve;
                element.onerror = reject;
                break;
            case 'style':
                element = document.createElement('link');
                element.rel = 'stylesheet';
                element.href = resource.path;
                element.onload = resolve;
                element.onerror = reject;
                break;
            case 'link':
                element = document.createElement('link');
                element.rel = 'preload';
                element.href = resource.path;
                element.as = resource.as || 'script';
                element.onload = resolve;
                element.onerror = reject;
                break;
            default:
                reject(new Error(`Invalid resource type: ${resource.type}`));
                return;
        }

        targetElement.appendChild(element);
    };

    const loadResourcesInOrder = (resources, index = 0) => {
        if (index >= resources.length) {
            return Promise.resolve();
        }

        const resource = resources[index];
        const cachedResource = resourceCache.get(resource.path);

        if (cachedResource) {
            return loadResourcesInOrder(resources, index + 1);
        }

        return new Promise((resolve, reject) => {
            loadResource(resource, resolve, reject);
        })
            .then(() => {
                resourceCache.set(resource.path, true);
                return loadResourcesInOrder(resources, index + 1);
            })
            .catch(error => {
                console.error(`Error loading resource ${resource.path}:`, error);
                return loadResourcesInOrder(resources, index + 1);
            });
    };

    return loadResourcesInOrder(resources);
}