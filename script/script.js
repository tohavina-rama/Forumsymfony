
        // Données du forum stockées en mémoire
        let forumData = {
            categories: [
                {
                    id: 1,
                    name: "Développement Web",
                    description: "HTML, CSS, JavaScript, frameworks modernes",
                    topics: 342,
                    posts: 1847,
                    icon: "💻"
                },
                {
                    id: 2,
                    name: "Développement Mobile",
                    description: "iOS, Android, React Native, Flutter",
                    topics: 189,
                    posts: 923,
                    icon: "📱"
                }
            ],
            topics: [
                {
                    id: 1,
                    title: "Comment optimiser les performances de React ?",
                    author: "Jean Dupont",
                    category: "Développement Web",
                    replies: 12,
                    views: 234,
                    lastPost: "Il y a 2 minutes"
                },
                {
                    id: 2,
                    title: "Flutter vs React Native en 2025",
                    author: "Marie Lefèvre",
                    category: "Développement Mobile",
                    replies: 8,
                    views: 156,
                    lastPost: "Il y a 15 minutes"
                },
                {
                    id: 3,
                    title: "Configuration Docker pour microservices",
                    author: "Pierre Martin",
                    category: "DevOps & Infrastructure",
                    replies: 15,
                    views: 367,
                    lastPost: "Il y a 10 minutes"
                }
            ],
            users: [
                { name: "Jean Dupont", avatar: "JD", online: true },
                { name: "Marie Lefèvre", avatar: "ML", online: true },
                { name: "Pierre Martin", avatar: "PM", online: true }
            ]
        };

        // Fonctions interactives
        function showSection(section) {
            console.log(`Navigation vers: ${section}`);
            // Ici vous pourriez implémenter la navigation entre sections
        }

        function toggleNotifications() {
            alert("Notifications: 3 nouveaux messages non lus");
        }

        function showLoginModal() {
            const username = prompt("Nom d'utilisateur:");
            if (username) {
                alert(`Bienvenue ${username}! (Simulation de connexion)`);
                updateUserInterface(username);
            }
        }

        function updateUserInterface(username) {
            const userMenu = document.querySelector('.user-menu');
            userMenu.innerHTML = `
                <button class="btn btn-secondary">🔔</button>
                <div class="user-tag">
                    <div class="online-indicator"></div>
                    <div class="avatar">${username.charAt(0).toUpperCase()}</div>
                    <span>${username}</span>
                </div>
                <button class="btn btn-secondary" onclick="logout()">Déconnexion</button>
            `;
        }

        function logout() {
            location.reload();
        }

        function searchForum(query) {
            if (query.length > 2) {
                console.log(`Recherche: "${query}"`);
                // Ici vous pourriez implémenter la recherche en temps réel
                highlightSearchResults(query);
            }
        }

        function highlightSearchResults(query) {
            const topics = document.querySelectorAll('.topic-title');
            topics.forEach(topic => {
                const text = topic.textContent;
                if (text.toLowerCase().includes(query.toLowerCase())) {
                    topic.style.background = 'linear-gradient(120deg, #a8edea 0%, #fed6e3 100%)';
                    topic.style.padding = '0.25rem';
                    topic.style.borderRadius = '0.25rem';
                } else {
                    topic.style.background = 'none';
                    topic.style.padding = '0';
                }
            });
        }

        function openTopic(topicId) {
            const topic = forumData.topics.find(t => t.id === topicId);
            if (topic) {
                alert(`Ouverture du sujet: "${topic.title}"\nAuteur: ${topic.author}\nRéponses: ${topic.replies}`);
                // Ici vous pourriez naviguer vers la page du sujet
            }
        }

        // Fonctionnalités avancées
        function createNewTopic() {
            const title = prompt("Titre du nouveau sujet:");
            if (title) {
                const newTopic = {
                    id: forumData.topics.length + 1,
                    title: title,
                    author: "Utilisateur Actuel",
                    category: "Général",
                    replies: 0,
                    views: 1,
                    lastPost: "À l'instant"
                };
                forumData.topics.unshift(newTopic);
                updateTopicsList();
            }
        }

        function updateTopicsList() {
            const topicList = document.querySelector('.topic-list');
            topicList.innerHTML = '';
            
            forumData.topics.forEach(topic => {
                const topicElement = document.createElement('div');
                topicElement.className = 'topic-item';
                topicElement.onclick = () => openTopic(topic.id);
                topicElement.innerHTML = `
                    <div class="avatar">${topic.author.split(' ').map(n => n[0]).join('')}</div>
                    <div class="topic-info">
                        <div class="topic-title">${topic.title}</div>
                        <div class="topic-meta">Par ${topic.author} • ${topic.category}</div>
                    </div>
                    <div class="topic-stats">
                        <span>${topic.replies} réponses</span>
                        <span>${topic.views} vues</span>
                    </div>
                `;
                topicList.appendChild(topicElement);
            });
        }

        // Effet de chargement progressif
        document.addEventListener('DOMContentLoaded', function() {
            const categories = document.querySelectorAll('.category');
            categories.forEach((category, index) => {
                category.style.opacity = '0';
                category.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    category.style.transition = 'all 0.6s ease-out';
                    category.style.opacity = '1';
                    category.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });

        // Simulation de mises à jour en temps réel
        setInterval(() => {
            const stats = document.querySelectorAll('.stat-number');
            if (stats.length > 0) {
                const randomStat = stats[Math.floor(Math.random() * stats.length)];
                const currentValue = parseInt(randomStat.textContent.replace(',', ''));
                randomStat.textContent = (currentValue + 1).toLocaleString();
            }
        }, 5000);

        // Gestion des raccourcis clavier
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 'k') {
                e.preventDefault();
                document.querySelector('.search-input').focus();
            }
            if (e.ctrlKey && e.key === 'n') {
                e.preventDefault();
                createNewTopic();
            }
        });