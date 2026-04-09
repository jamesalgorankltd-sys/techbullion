/**
 * WACUS Theme - Three.js 3D Effects
 * Particles, Blob, Globe and other 3D effects
 */

(function() {
    'use strict';

    // Check if Three.js is available
    if (typeof THREE === 'undefined') {
        console.warn('Three.js not loaded');
        return;
    }

    // =====================================================
    // PARTICLE SYSTEM
    // =====================================================
    class ParticleSystem {
        constructor(container, options = {}) {
            this.container = container;
            this.options = Object.assign({
                particleCount: 2000,
                particleSize: 0.015,
                particleColor: 0xffffff,
                speed: 0.0005,
                mouseInfluence: 0.1,
                depth: 10
            }, options);

            this.mouse = { x: 0, y: 0 };
            this.init();
        }

        init() {
            // Scene
            this.scene = new THREE.Scene();

            // Camera
            this.camera = new THREE.PerspectiveCamera(
                75,
                this.container.offsetWidth / this.container.offsetHeight,
                0.1,
                1000
            );
            this.camera.position.z = 5;

            // Renderer
            this.renderer = new THREE.WebGLRenderer({
                alpha: true,
                antialias: true
            });
            this.renderer.setSize(this.container.offsetWidth, this.container.offsetHeight);
            this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
            this.container.appendChild(this.renderer.domElement);

            // Create particles
            this.createParticles();

            // Events
            this.bindEvents();

            // Start animation
            this.animate();
        }

        createParticles() {
            const geometry = new THREE.BufferGeometry();
            const positions = new Float32Array(this.options.particleCount * 3);
            const velocities = new Float32Array(this.options.particleCount * 3);

            for (let i = 0; i < this.options.particleCount; i++) {
                const i3 = i * 3;
                positions[i3] = (Math.random() - 0.5) * this.options.depth;
                positions[i3 + 1] = (Math.random() - 0.5) * this.options.depth;
                positions[i3 + 2] = (Math.random() - 0.5) * this.options.depth;

                velocities[i3] = (Math.random() - 0.5) * 0.01;
                velocities[i3 + 1] = (Math.random() - 0.5) * 0.01;
                velocities[i3 + 2] = (Math.random() - 0.5) * 0.01;
            }

            geometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
            this.velocities = velocities;

            // Material with custom shader
            const material = new THREE.PointsMaterial({
                color: this.options.particleColor,
                size: this.options.particleSize,
                transparent: true,
                opacity: 0.8,
                blending: THREE.AdditiveBlending,
                sizeAttenuation: true
            });

            this.particles = new THREE.Points(geometry, material);
            this.scene.add(this.particles);
        }

        bindEvents() {
            window.addEventListener('resize', () => this.onResize());
            document.addEventListener('mousemove', (e) => this.onMouseMove(e));
        }

        onResize() {
            this.camera.aspect = this.container.offsetWidth / this.container.offsetHeight;
            this.camera.updateProjectionMatrix();
            this.renderer.setSize(this.container.offsetWidth, this.container.offsetHeight);
        }

        onMouseMove(e) {
            this.mouse.x = (e.clientX / window.innerWidth) * 2 - 1;
            this.mouse.y = -(e.clientY / window.innerHeight) * 2 + 1;
        }

        animate() {
            requestAnimationFrame(() => this.animate());

            const positions = this.particles.geometry.attributes.position.array;

            for (let i = 0; i < this.options.particleCount; i++) {
                const i3 = i * 3;

                // Update positions with velocity
                positions[i3] += this.velocities[i3];
                positions[i3 + 1] += this.velocities[i3 + 1];
                positions[i3 + 2] += this.velocities[i3 + 2];

                // Mouse influence
                positions[i3] += this.mouse.x * this.options.mouseInfluence * 0.01;
                positions[i3 + 1] += this.mouse.y * this.options.mouseInfluence * 0.01;

                // Boundary check
                const halfDepth = this.options.depth / 2;
                if (Math.abs(positions[i3]) > halfDepth) this.velocities[i3] *= -1;
                if (Math.abs(positions[i3 + 1]) > halfDepth) this.velocities[i3 + 1] *= -1;
                if (Math.abs(positions[i3 + 2]) > halfDepth) this.velocities[i3 + 2] *= -1;
            }

            this.particles.geometry.attributes.position.needsUpdate = true;

            // Rotate based on mouse
            this.particles.rotation.x += (this.mouse.y * 0.1 - this.particles.rotation.x) * 0.05;
            this.particles.rotation.y += (this.mouse.x * 0.1 - this.particles.rotation.y) * 0.05;

            this.renderer.render(this.scene, this.camera);
        }
    }

    // =====================================================
    // ANIMATED BLOB
    // =====================================================
    class AnimatedBlob {
        constructor(container, options = {}) {
            this.container = container;
            this.options = Object.assign({
                color: 0x00ff88,
                wireframe: false,
                speed: 0.003,
                complexity: 0.3,
                amplitude: 0.5
            }, options);

            this.time = 0;
            this.init();
        }

        init() {
            // Scene
            this.scene = new THREE.Scene();

            // Camera
            this.camera = new THREE.PerspectiveCamera(
                50,
                this.container.offsetWidth / this.container.offsetHeight,
                0.1,
                1000
            );
            this.camera.position.z = 4;

            // Renderer
            this.renderer = new THREE.WebGLRenderer({
                alpha: true,
                antialias: true
            });
            this.renderer.setSize(this.container.offsetWidth, this.container.offsetHeight);
            this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
            this.container.appendChild(this.renderer.domElement);

            // Lights
            const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
            this.scene.add(ambientLight);

            const pointLight = new THREE.PointLight(0xffffff, 1);
            pointLight.position.set(5, 5, 5);
            this.scene.add(pointLight);

            // Create blob
            this.createBlob();

            // Events
            window.addEventListener('resize', () => this.onResize());

            // Start animation
            this.animate();
        }

        createBlob() {
            const geometry = new THREE.IcosahedronGeometry(1.5, 64);
            
            const material = new THREE.MeshPhongMaterial({
                color: this.options.color,
                wireframe: this.options.wireframe,
                shininess: 100,
                transparent: true,
                opacity: 0.9
            });

            this.blob = new THREE.Mesh(geometry, material);
            this.originalPositions = geometry.attributes.position.array.slice();
            this.scene.add(this.blob);
        }

        onResize() {
            this.camera.aspect = this.container.offsetWidth / this.container.offsetHeight;
            this.camera.updateProjectionMatrix();
            this.renderer.setSize(this.container.offsetWidth, this.container.offsetHeight);
        }

        animate() {
            requestAnimationFrame(() => this.animate());

            this.time += this.options.speed;

            const positions = this.blob.geometry.attributes.position.array;

            for (let i = 0; i < positions.length; i += 3) {
                const x = this.originalPositions[i];
                const y = this.originalPositions[i + 1];
                const z = this.originalPositions[i + 2];

                const noise = Math.sin(x * this.options.complexity + this.time) *
                             Math.sin(y * this.options.complexity + this.time) *
                             Math.sin(z * this.options.complexity + this.time) *
                             this.options.amplitude;

                positions[i] = x + x * noise * 0.3;
                positions[i + 1] = y + y * noise * 0.3;
                positions[i + 2] = z + z * noise * 0.3;
            }

            this.blob.geometry.attributes.position.needsUpdate = true;
            this.blob.geometry.computeVertexNormals();

            this.blob.rotation.x += 0.002;
            this.blob.rotation.y += 0.003;

            this.renderer.render(this.scene, this.camera);
        }
    }

    // =====================================================
    // 3D GLOBE
    // =====================================================
    class Globe {
        constructor(container, options = {}) {
            this.container = container;
            this.options = Object.assign({
                radius: 2,
                segments: 64,
                color: 0x1a1a2e,
                wireframe: true,
                wireframeColor: 0x00ff88,
                rotationSpeed: 0.001,
                dots: true,
                dotColor: 0xffffff,
                dotSize: 0.02
            }, options);

            this.init();
        }

        init() {
            // Scene
            this.scene = new THREE.Scene();

            // Camera
            this.camera = new THREE.PerspectiveCamera(
                45,
                this.container.offsetWidth / this.container.offsetHeight,
                0.1,
                1000
            );
            this.camera.position.z = 6;

            // Renderer
            this.renderer = new THREE.WebGLRenderer({
                alpha: true,
                antialias: true
            });
            this.renderer.setSize(this.container.offsetWidth, this.container.offsetHeight);
            this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
            this.container.appendChild(this.renderer.domElement);

            // Create globe
            this.createGlobe();

            // Create dots
            if (this.options.dots) {
                this.createDots();
            }

            // Events
            window.addEventListener('resize', () => this.onResize());

            // Start animation
            this.animate();
        }

        createGlobe() {
            // Solid sphere
            const sphereGeometry = new THREE.SphereGeometry(
                this.options.radius,
                this.options.segments,
                this.options.segments
            );
            
            const sphereMaterial = new THREE.MeshBasicMaterial({
                color: this.options.color,
                transparent: true,
                opacity: 0.8
            });

            this.sphere = new THREE.Mesh(sphereGeometry, sphereMaterial);
            this.scene.add(this.sphere);

            // Wireframe
            const wireframeGeometry = new THREE.SphereGeometry(
                this.options.radius + 0.01,
                24,
                24
            );
            
            const wireframeMaterial = new THREE.MeshBasicMaterial({
                color: this.options.wireframeColor,
                wireframe: true,
                transparent: true,
                opacity: 0.3
            });

            this.wireframe = new THREE.Mesh(wireframeGeometry, wireframeMaterial);
            this.scene.add(this.wireframe);

            // Outer glow ring
            const ringGeometry = new THREE.RingGeometry(
                this.options.radius + 0.3,
                this.options.radius + 0.35,
                64
            );
            
            const ringMaterial = new THREE.MeshBasicMaterial({
                color: this.options.wireframeColor,
                transparent: true,
                opacity: 0.5,
                side: THREE.DoubleSide
            });

            this.ring = new THREE.Mesh(ringGeometry, ringMaterial);
            this.ring.rotation.x = Math.PI / 2;
            this.scene.add(this.ring);
        }

        createDots() {
            const dotsGeometry = new THREE.BufferGeometry();
            const dotCount = 1000;
            const positions = new Float32Array(dotCount * 3);

            for (let i = 0; i < dotCount; i++) {
                const phi = Math.acos(-1 + (2 * i) / dotCount);
                const theta = Math.sqrt(dotCount * Math.PI) * phi;

                const x = this.options.radius * Math.cos(theta) * Math.sin(phi);
                const y = this.options.radius * Math.sin(theta) * Math.sin(phi);
                const z = this.options.radius * Math.cos(phi);

                positions[i * 3] = x;
                positions[i * 3 + 1] = y;
                positions[i * 3 + 2] = z;
            }

            dotsGeometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));

            const dotsMaterial = new THREE.PointsMaterial({
                color: this.options.dotColor,
                size: this.options.dotSize,
                transparent: true,
                opacity: 0.8
            });

            this.dots = new THREE.Points(dotsGeometry, dotsMaterial);
            this.scene.add(this.dots);
        }

        onResize() {
            this.camera.aspect = this.container.offsetWidth / this.container.offsetHeight;
            this.camera.updateProjectionMatrix();
            this.renderer.setSize(this.container.offsetWidth, this.container.offsetHeight);
        }

        animate() {
            requestAnimationFrame(() => this.animate());

            this.sphere.rotation.y += this.options.rotationSpeed;
            this.wireframe.rotation.y += this.options.rotationSpeed;
            
            if (this.dots) {
                this.dots.rotation.y += this.options.rotationSpeed;
            }

            this.renderer.render(this.scene, this.camera);
        }
    }

    // =====================================================
    // FLOATING OBJECTS
    // =====================================================
    class FloatingObjects {
        constructor(container, options = {}) {
            this.container = container;
            this.options = Object.assign({
                objectCount: 20,
                colors: [0x00ff88, 0xff0055, 0x00aaff, 0xffaa00],
                minSize: 0.1,
                maxSize: 0.5,
                speed: 0.01
            }, options);

            this.objects = [];
            this.init();
        }

        init() {
            // Scene
            this.scene = new THREE.Scene();

            // Camera
            this.camera = new THREE.PerspectiveCamera(
                60,
                this.container.offsetWidth / this.container.offsetHeight,
                0.1,
                1000
            );
            this.camera.position.z = 10;

            // Renderer
            this.renderer = new THREE.WebGLRenderer({
                alpha: true,
                antialias: true
            });
            this.renderer.setSize(this.container.offsetWidth, this.container.offsetHeight);
            this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
            this.container.appendChild(this.renderer.domElement);

            // Lights
            const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
            this.scene.add(ambientLight);

            const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
            directionalLight.position.set(5, 5, 5);
            this.scene.add(directionalLight);

            // Create objects
            this.createObjects();

            // Events
            window.addEventListener('resize', () => this.onResize());

            // Start animation
            this.animate();
        }

        createObjects() {
            const geometries = [
                new THREE.BoxGeometry(1, 1, 1),
                new THREE.SphereGeometry(0.5, 32, 32),
                new THREE.ConeGeometry(0.5, 1, 32),
                new THREE.TorusGeometry(0.3, 0.1, 16, 32),
                new THREE.OctahedronGeometry(0.5),
                new THREE.TetrahedronGeometry(0.5)
            ];

            for (let i = 0; i < this.options.objectCount; i++) {
                const geometry = geometries[Math.floor(Math.random() * geometries.length)];
                const color = this.options.colors[Math.floor(Math.random() * this.options.colors.length)];
                
                const material = new THREE.MeshPhongMaterial({
                    color: color,
                    transparent: true,
                    opacity: 0.8,
                    shininess: 100
                });

                const mesh = new THREE.Mesh(geometry, material);
                
                const scale = this.options.minSize + Math.random() * (this.options.maxSize - this.options.minSize);
                mesh.scale.set(scale, scale, scale);

                mesh.position.x = (Math.random() - 0.5) * 15;
                mesh.position.y = (Math.random() - 0.5) * 15;
                mesh.position.z = (Math.random() - 0.5) * 10;

                mesh.rotation.x = Math.random() * Math.PI;
                mesh.rotation.y = Math.random() * Math.PI;

                mesh.userData = {
                    rotationSpeed: {
                        x: (Math.random() - 0.5) * 0.02,
                        y: (Math.random() - 0.5) * 0.02
                    },
                    floatSpeed: Math.random() * 0.01 + 0.005,
                    floatOffset: Math.random() * Math.PI * 2
                };

                this.objects.push(mesh);
                this.scene.add(mesh);
            }
        }

        onResize() {
            this.camera.aspect = this.container.offsetWidth / this.container.offsetHeight;
            this.camera.updateProjectionMatrix();
            this.renderer.setSize(this.container.offsetWidth, this.container.offsetHeight);
        }

        animate() {
            requestAnimationFrame(() => this.animate());

            const time = Date.now() * 0.001;

            this.objects.forEach(obj => {
                obj.rotation.x += obj.userData.rotationSpeed.x;
                obj.rotation.y += obj.userData.rotationSpeed.y;
                obj.position.y += Math.sin(time + obj.userData.floatOffset) * obj.userData.floatSpeed;
            });

            this.renderer.render(this.scene, this.camera);
        }
    }

    // =====================================================
    // WAVE EFFECT
    // =====================================================
    class WaveEffect {
        constructor(container, options = {}) {
            this.container = container;
            this.options = Object.assign({
                color: 0x00ff88,
                wireframe: true,
                amplitude: 0.5,
                frequency: 0.5,
                speed: 0.02
            }, options);

            this.time = 0;
            this.init();
        }

        init() {
            // Scene
            this.scene = new THREE.Scene();

            // Camera
            this.camera = new THREE.PerspectiveCamera(
                60,
                this.container.offsetWidth / this.container.offsetHeight,
                0.1,
                1000
            );
            this.camera.position.set(0, 3, 5);
            this.camera.lookAt(0, 0, 0);

            // Renderer
            this.renderer = new THREE.WebGLRenderer({
                alpha: true,
                antialias: true
            });
            this.renderer.setSize(this.container.offsetWidth, this.container.offsetHeight);
            this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
            this.container.appendChild(this.renderer.domElement);

            // Create wave plane
            this.createWave();

            // Events
            window.addEventListener('resize', () => this.onResize());

            // Start animation
            this.animate();
        }

        createWave() {
            const geometry = new THREE.PlaneGeometry(10, 10, 64, 64);
            
            const material = new THREE.MeshBasicMaterial({
                color: this.options.color,
                wireframe: this.options.wireframe,
                transparent: true,
                opacity: 0.7
            });

            this.wave = new THREE.Mesh(geometry, material);
            this.wave.rotation.x = -Math.PI / 2;
            this.originalPositions = geometry.attributes.position.array.slice();
            this.scene.add(this.wave);
        }

        onResize() {
            this.camera.aspect = this.container.offsetWidth / this.container.offsetHeight;
            this.camera.updateProjectionMatrix();
            this.renderer.setSize(this.container.offsetWidth, this.container.offsetHeight);
        }

        animate() {
            requestAnimationFrame(() => this.animate());

            this.time += this.options.speed;

            const positions = this.wave.geometry.attributes.position.array;

            for (let i = 0; i < positions.length; i += 3) {
                const x = this.originalPositions[i];
                const y = this.originalPositions[i + 1];

                positions[i + 2] = Math.sin(x * this.options.frequency + this.time) *
                                   Math.sin(y * this.options.frequency + this.time) *
                                   this.options.amplitude;
            }

            this.wave.geometry.attributes.position.needsUpdate = true;

            this.renderer.render(this.scene, this.camera);
        }
    }

    // =====================================================
    // AUTO INITIALIZATION
    // =====================================================
    document.addEventListener('DOMContentLoaded', function() {
        // Particle containers
        document.querySelectorAll('.particles-container').forEach(container => {
            new ParticleSystem(container, {
                particleCount: parseInt(container.dataset.count) || 2000,
                particleColor: parseInt(container.dataset.color) || 0xffffff
            });
        });

        // Blob containers
        document.querySelectorAll('.blob-container').forEach(container => {
            new AnimatedBlob(container, {
                color: parseInt(container.dataset.color) || 0x00ff88
            });
        });

        // Globe containers
        document.querySelectorAll('.globe-container').forEach(container => {
            new Globe(container, {
                wireframeColor: parseInt(container.dataset.color) || 0x00ff88
            });
        });

        // Floating objects containers
        document.querySelectorAll('.floating-objects-container').forEach(container => {
            new FloatingObjects(container);
        });

        // Wave containers
        document.querySelectorAll('.wave-container').forEach(container => {
            new WaveEffect(container, {
                color: parseInt(container.dataset.color) || 0x00ff88
            });
        });
    });

    // Expose classes globally
    window.WacusThree = {
        ParticleSystem,
        AnimatedBlob,
        Globe,
        FloatingObjects,
        WaveEffect
    };

})();
