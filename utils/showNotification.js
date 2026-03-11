export default function showNotification(message, type = "info") {
  const existingNotifications = document.querySelectorAll(".notification");
  existingNotifications.forEach((notification) => notification.remove());

  const notification = document.createElement("div");
  notification.className = `notification fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-md transform transition-all duration-500 translate-x-full`;

  const styles = {
    success: "bg-green-600 text-white border-green-700",
    error: "bg-red-600 text-white border-red-700",
    info: "bg-blue-600 text-white border-blue-700",
    warning: "bg-yellow-600 text-white border-yellow-700",
  };

  notification.className += ` ${styles[type] || styles.info}`;

  const icon = {
    success: "fas fa-check-circle",
    error: "fas fa-exclamation-circle",
    info: "fas fa-info-circle",
    warning: "fas fa-exclamation-triangle",
  };

  notification.innerHTML = `
    <div class="flex items-start">
      <i class="${icon[type] || icon.info} text-xl mr-3 mt-0.5"></i>
      <div class="flex-1">
        <p class="font-medium">${message}</p>
      </div>
      <button class="ml-4 text-white hover:text-gray-200 transition-colors" onclick="this.parentElement.parentElement.remove()">
        <i class="fas fa-times"></i>
      </button>
    </div>
  `;

  document.body.appendChild(notification);

  setTimeout(() => {
    notification.classList.remove("translate-x-full");
  }, 100);

  setTimeout(() => {
    notification.classList.add("translate-x-full");
    setTimeout(() => {
      if (notification.parentNode) notification.remove();
    }, 500);
  }, 5000);
}
