<?php
/**
 * Created by PhpStorm.
 * User: 火子 QQ：284503866.
 * Date: 2021/3/31
 * Time: 10:08
 */

namespace Wanphp\ComposerInstallersExtender;


use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

class Installer extends LibraryInstaller
{
  /**
   * {@inheritDoc}
   */
  public function getPackageBasePath(PackageInterface $package)
  {
    $prefix = substr($package->getPrettyName(), 0, 16);
    if ('wanphp/composer-' !== $prefix) {
      throw new \InvalidArgumentException(
        '不能安装扩展, Wanphp 扩展应以"wanphp/composer-"开头。'
      );
    }

    return 'wanphp/extend/' . substr($package->getPrettyName(), 16);
  }

  public function getInstallPath(PackageInterface $package): string
  {
    $prefix = substr($package->getPrettyName(), 0, 16);
    if ('wanphp/composer-' === $prefix) $path = 'wanphp/extend/' . substr($package->getPrettyName(), 16);

    return $path ?: parent::getInstallPath($package);
  }


  /**
   * {@inheritDoc}
   */
  public function supports($packageType)
  {
    return 'wanphp-extend' === $packageType;
  }
}
